<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = ['id'];
    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'quantity',
        'price',
        'category'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function seller(): BelongsTo {
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
