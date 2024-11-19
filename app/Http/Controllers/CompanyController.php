<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        // $this->middleware(['permission:company-list|company-edit|company-delete|company-create']);
        $this->middleware('check.role:Gl_admin');
    }
    public function index()
    {
        $companies=Company::where('deleted_at',null)->orderBy('id','desc')->paginate(20);
        return view('pages.companies.index',compact('companies'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function key(Request $request,User $user){
        Auth::logout();
        Auth::login($user);

        return redirect()->route('home');
    }
}
