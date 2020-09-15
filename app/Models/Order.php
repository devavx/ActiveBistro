<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
	public function user (): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function items (): HasMany
	{
		return $this->hasMany(OrderItem::class);
	}

	public function address (): BelongsTo
	{
		return $this->belongsTo(Address::class);
	}

	public function secondAddress (): BelongsTo
	{
		return $this->belongsTo(Address::class, 'second_address_id');
	}
}
