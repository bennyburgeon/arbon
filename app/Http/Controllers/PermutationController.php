<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permutation;
class PermutationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = Permutation::where('status',1)->get();
        return view('admin.permutation.list',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.permutation.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'word'=> 'required|unique:permutations,word',
            
        ]);
       
        $permutation = new Permutation([
            'word' => request('word')
        ]);
        $permutation->save();
        return redirect('permutations');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
        $permutation = Permutation::find(decrypt($id));
        return view('admin.permutation.edit',compact('permutation'));
          
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'word'=> 'required|unique:permutation,word,' .$id,            
        ]);
     
        $permutation = Permutation::find($id);
        $permutation->word =request('word');
        $permutation->save();
        return redirect('permutation');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
