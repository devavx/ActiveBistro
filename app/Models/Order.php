<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
	protected $fillable = [
		'user_id', 'address_id', 'second_address_id', 'invoice_id', 'payment_slab', 'quantity', 'sub_total', 'total', 'status'
	];

	protected static function boot ()
	{
		parent::boot();
		self::deleting(function (Order $order) {
			$order->items()->delete();
		});
	}

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
