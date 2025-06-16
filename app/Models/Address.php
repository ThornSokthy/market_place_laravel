<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'street',
        'commune',
        'district',
        'city',
        'postal_code',
        'is_default',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
