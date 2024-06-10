<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permutation;
use App\Models\PermutationAnswers;
class CandidatePermutationController extends Controller
{
    public function candidateQuestions()
    {
        $person=auth()->guard('candidate')->user()->id;
        $lists = Permutation::whereHas('answers', function ($query) use ($person) {
            $query->where('user_id', $person); 
        })->withSum('answers', 'points')->get();
        return view('candidate.questions.list',compact('lists'));
    }
    public function attendQuestions($id)
    {
        $question = Permutation::find(decrypt($id));
        return view('candidate.questions.attend',compact('question'));
    }
    public function listAnswer(Request $request){
        $request->validate([
            'qid'=>'required',
        ]);
        $answers = PermutationAnswers::where('question_id',request('qid'))
                                        ->where('user_id',auth()->guard('candidate')->user()->id)
                                        ->get();
        if (count($answers)!=0){
            return response()->json(['status' => 'success', 'data' => $answers ]);
            
        }else{
            return response()->json(['status' => 'error', 'message' => "Somthing went wrong"]);
        }
    }
    public function checkAnswer(Request $request){
        $request->validate([
            'word'=>'required',
            'question_id'=>'required',
        ]);
        $question = Permutation::find(request('question_id'));
        if( $question->word==request('word')){
            return response()->json(['status' => 'error', 'message' => "error Both are same string"]);
        }
        $get_last_word = PermutationAnswers::where('question_id',request('question_id'))
                        ->where('user_id',auth()->guard('candidate')->user()->id)
                        ->orderBy('id', 'desc')->first();
            if ($get_last_word) {
                $str1= $get_last_word->word;
            }else{
                $str1=$question->word;
            }
        
        $str2=request('word');
        $already_exist = PermutationAnswers::where('question_id',request('question_id'))
                        ->where('user_id',auth()->guard('candidate')->user()->id)
                        ->where('word',request('word'))
                        ->get();
        if (count($already_exist)==0) {
            if (str_contains($str1, $str2)) { 
                $check =$this->checkValidString($str2);
                        if ($check==1){
                            $result = $this->removeAlphabets($str1, $str2);

                            $answer = new PermutationAnswers([
                                'question_id' =>request('question_id'),
                                'user_id' =>auth()->guard('candidate')->user()->id,
                                'word'=> $str2,
                                'balance_letters' => $result,
                                'points' => strlen($str2)
                            ]);
                            $answer->save();
                            return response()->json(['status' => 'success', 'data-one' => $str2 ,'data-two' => $result]);
                            
                        }else{
                            return response()->json(['status' => 'error', 'message' => "error string not vaid"]);
                        }
            }else{
                return response()->json(['status' => 'error', 'message' => "error not a string"]);
                
            }
        }else{
            return response()->json(['status' => 'error', 'message' => "error string already exist"]);
        }

    }
    function checkValidString($word){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.dictionaryapi.dev/api/v2/entries/en/$word");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $data = json_decode($response, true);
                if (!isset($data['title']) || $data['title'] !== 'No Definitions Found') {
                    return 1;
                } else {
                    return 2;
                }
            }
        curl_close($ch);
    }
    function removeAlphabets($string, $alphabetsToRemove) {
        // Convert the string of alphabets to an array
         $alphabetsArray = str_split($alphabetsToRemove);
        // Iterate over each alphabet and replace it with an empty string
        foreach ($alphabetsArray as $alphabet) {
            $alphabet = '/'.preg_quote($alphabet, '/').'/';
            $string =  preg_replace($alphabet, '', $string, 1);
        }
        return $string;
    }
}
