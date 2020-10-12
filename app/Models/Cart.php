<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
	protected $fillable = [
		'user_id', 'items', 'coupon_code', 'calories', 'fats', 'proteins', 'carbohydrates', 'wantBreakfast', 'wantSnacks', 'weekendMeals', 'snackCount', 'mealsPerDay', 'dietaryRequirement', 'allergies', 'coupon_id', 'discount', 'subTotal', 'total',
		'address_id', 'second_address_id', 'paymentSlab', 'staffDiscount', 'invoiceId'
	];
	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];
	protected $casts = [
		'items' => 'object',
		'allergies' => 'array',
		'wantBreakfast' => 'bool',
		'wantSnacks' => 'bool',
		'weekendMeals' => 'bool',
		'staffDiscount' => 'bool',
	];

	protected static function boot ()
	{
		parent::boot();
		self::creating(function (Cart $cart) {
			$cart->invoiceId = strtoupper(substr(md5(microtime()), 0, 7));
			$cart->items = [];
			$cart->allergies = [];
		});
	}

	public function user (): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function coupon (): BelongsTo
	{
		return $this->belongsTo(Coupon::class);
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