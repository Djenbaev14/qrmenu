<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded=['id'];
    
    public function main_category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }
    public function product(): HasMany
    {
        return $this->HasMany(Product::class);
    }
    public function company(): BelongsTo
    {
        return $this->BelongsTo(Company::class);
    }
    public function icon()
    {
        return $this->morphOne(Attachment::class, 'attachment');
    }
}
