<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
class AdminController extends Controller
{
    public function adminDashboard(){
        return view('admin.dashboard');
    }
    public function candidatesList(){
        $lists = Candidate::where('status',1);
        if(request('name')){
            $search_key['name']=request('name');
         $lists =$lists->where('name', 'like', '%'.request('name').'%');  
        }else{
            $search_key['name']=''; 
        }
        if(request('email')){
            $search_key['email']=request('email');
            $lists =$lists->where('email', 'like', '%'.request('email').'%') ;  
        }else{
            $search_key['email']=''; 
        }
        if(request('min_exp')){
        $search_key['min_exp']=request('min_exp');
        $lists =$lists->where('experience', '<=', request('min_exp')) ;  
        }else{
            $search_key['min_exp']=''; 
        }
        if(request('max_exp')){
        $search_key['max_exp']=request('max_exp');
        $lists =$lists->where('experience', '>=', request('max_exp')) ;  
        }else{
            $search_key['max_exp']=''; 
        }
           
            $lists=$lists->get();

        return view('admin.candidate-list',compact('lists','search_key'));
    }
    public function candidateDashboard(){
        return view('candidate.dashboard');
    }
}
