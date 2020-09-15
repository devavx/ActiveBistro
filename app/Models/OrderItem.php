<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
	protected $fillable = [
		'order_id', 'meal_plan_id', 'item_id', 'quantity', 'actual_price', 'selling_price', 'total', 'items'
	];

	protected $casts = [
		'items' => 'object'
	];

	public function order (): BelongsTo
	{
		return $this->belongsTo(Order::class);
	}
}
