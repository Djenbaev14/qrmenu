<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks=Opinion::orderBy('id','desc')->paginate(10);
        return view('pages.feedback.index',compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:opinions,name,'.$request->name,
            'text'=>'required'
        ]);
        

        $feedback=new Opinion();
        $feedback->company_id=auth()->user()->company->id;
        $feedback->name=$request->name;
        $feedback->text=$request->text;
        $feedback->save();
        return redirect()->back()->with('success','Feedback sent successfully');
    }
    /** lorem100
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opinion $feedback)
    {
        $request->validate([
            'name'=>'required',
            'text'=>'required'
        ]);
        $feedback->name=$request->name;
        $feedback->text=$request->text;
        $feedback->save();
        return redirect()->back()->with('success','Feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback=Opinion::find($id);
        $feedback->delete();
        return redirect()->back()->with('success','Feedback deleted successfully');
    }
}
