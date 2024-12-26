<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'order_number'=>$this->order_number,
            'order_date'=>$this->created_at,
            'address'=>$this->delivery_address,
            'payment_status'=>$this->payment_status,
            'payment_method'=>$this->payment_method,
            'notes'=>$this->notes,
            "order_list"=>OrderListResource::collection(OrderList::where('order_id',$this->id)->get())
        ];
    }
}
