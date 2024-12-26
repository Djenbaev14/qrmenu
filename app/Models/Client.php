<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $guarded=['id'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function order(): HasMany
    {
        return $this->HasMany(Order::class);
    }
}
