<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'items'
    ];
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    protected $casts = [
        'items' => 'object'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (Cart $cart) {
            $cart->items = [];
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}