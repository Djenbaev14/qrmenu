<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=['id'];
    public function company(): BelongsTo
    {
        return $this->BelongsTo(Company::class);
    }
    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }
    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class);
    }
    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class);
    }
    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    // Buyurtmaning oxirgi statusini olish
    public function getLastStatus()
    {
        return $this->statusLogs()->latest()->first();
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            // Order raqamini yaratish: "ORDER-YYYY-XXXX"
            $lastOrder = Order::latest()->first(); // Yangi buyurtma raqamiga muvofiq eng oxirgi buyurtmani olish
            $orderNumber = 'ORDER-' . date('Y') . '-' . str_pad(($lastOrder ? $lastOrder->id + 1 : 1), 4, '0', STR_PAD_LEFT);
            $order->order_number = $orderNumber;
        });
    }

}
