<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    // guarded
    protected $guarded = ['id'];
    protected $casts = [
        'telephones' => 'array', // JSON maydonni array sifatida olish
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
    public function icon()
    {
        return $this->morphOne(Attachment::class, 'attachment');
    }
    public function feedback()
    {
        return $this->hasMany(Opinion::class);
    }
    public function category()
    {
        return $this->hasMany(Category::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    
}
