<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $client = new Client();
            $client->name = $request->name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->save();

            $order=new Order();
            $order->client_id = $client->id;
            $order->company_id = $request->company_id;
            $order->category_id = $request->category_id;
            $order->product_id = $request->product_id;
            $order->save();
            
            return ApiResponse::success($client, "Klient muvafaqiyatli qo'shildi");
        } catch (\Exception $e) {
            return ApiResponse::error("Klient qo'shishda xatolik yuz berdi", 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
