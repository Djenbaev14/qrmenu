<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders=OrderResource::collection(Order::where('client_id',$request->user()->id)->whereNull('deleted_at')->get());
        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'address' => 'required',
            'order_items' => 'required|array|min:1', // order_items massiv bo'lishi kerak va kamida 1 ta element bo'lishi kerak
            'order_items.*.product_id' => 'required|integer|exists:products,id', // product_id integer bo'lishi va mavjud bo'lishi kerak
            'order_items.*.quantity' => 'required|integer|min:1', // quantity kamida 1 bo'lishi kerak
        ]);
        $order = Order::create([
            "company_id"=>$request->company_id,
            'client_id' => $request->user()->id,
            'delivery_address' => $request->address,
        ]);
        for ($i=0; $i < count($request->order_items); $i++) { 
            OrderList::create([
                "order_id"=>$order->id,
                "company_id"=>$request->company_id,
                "product_id"=>$request->order_items[$i]['product_id'],
                "quantity"=>$request->order_items[$i]['quantity'],
                "price"=>Product::find($request->order_items[$i]['product_id'])->price
            ]);
        }

        return response()->json([
            'message' => 'Buyurtma muvaffaqiyatli yaratildi.',
            'order' => $order,
        ]);
    }

    public function show(Request $request,$id){
        $orders= new OrderResource(Order::where('client_id',$request->user()->id)->whereNull('deleted_at')->findOrFail($id));
        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }
}
