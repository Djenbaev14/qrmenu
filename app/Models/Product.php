<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    
    protected $casts = [
        'photos' => 'array', // JSON maydonni array sifatida olish
    ];
    public function images()
    {
        return $this->morphMany(Attachment::class, 'attachment');
    }
    public function scopeActive(Builder $builder){
        $builder->where('is_active', 1);
    }
}
