<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = ['id'];
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'order_date',
        'total_amount',
        'address_id'
    ];
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Relationship with the seller (user)
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): BelongsTo {
        return $this->belongsTo(Address::class);
    }
}
