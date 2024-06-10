<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('candidate.layout.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=> 'required|email|unique:candidates,email',
            'phone'=> 'required|numeric|digits_between:8,13|unique:candidates,phone',
            
        ]);
       
        $candidate = new Candidate([
            'name' => request('name'),
            'email' => request('email'),
            'phone'=> request('phone'),
            'password'=> app('hash')->make(request('phone'))
        ]);
        $candidate->save();
        return redirect('login');

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
       
        $candidate = Candidate::find(decrypt($id));
        return view('candidate.edit-profile',compact('candidate'));
          
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=> 'required|email|unique:candidates,email,' .$id,
            'phone'=> 'required|numeric|digits_between:8,13|unique:candidates,phone,' .$id,
            
        ]);
     
        $candidate = Candidate::find($id);
        $candidate->name =request('name');
        $candidate->email =request('email');
        $candidate->phone =request('phone');
        $candidate->save();
        return redirect('candidate-dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
