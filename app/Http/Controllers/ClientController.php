<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('only-thier-clients-list')){
            $company_id=Company::where('user_id',auth()->user()->id)->first()->id;
            $orders=Order::where('company_id',$company_id)->where('deleted_at',null)->orderBy('id','desc')->paginate(20);
        }elseif(auth()->user()->can('all-clients-list')){
            $orders=Order::where('deleted_at',null)->orderBy('id','desc')->paginate(20);
        }
        return view('pages.clients.index',compact('orders'));
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
}
