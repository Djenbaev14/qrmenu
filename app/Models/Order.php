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

}
