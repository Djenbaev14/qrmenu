<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Barcha buyurtmalarni ko'rsatish
    public function index()
    {
        $orders = Order::with('statusLogs')->get();
        return view('pages.orders.index', compact('orders'));
    }

    // Yangi buyurtmalar
    public function news()
    {
        // $orders = Order::with('statusLogs')->get(); // Yangi buyurtmalar  
        $orders='new';
        return view('pages.orders.index', compact('orders'));
    }

    // Muddati o'tgan buyurtmalar
    public function expired()
    {
        $orders = Order::where('status', 'expired')->latest()->get();
        return view('pages.orders.index', compact('orders'));
    }

    // Tayyor buyurtmalar
    public function ready()
    {
        $orders = Order::where('status', 'ready')->latest()->get();
        return view('pages.orders.index', compact('orders'));
    }

    // Buyurtmalar tarixini ko'rsatish
    public function history()
    {
        $orders = Order::where('status', 'history')->latest()->get();
        return view('pages.orders.index', compact('orders'));
    }   
}
