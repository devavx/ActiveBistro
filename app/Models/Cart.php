<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
	protected $fillable = [
		'user_id', 'items', 'coupon', 'calories', 'fats', 'proteins', 'carbohydrates', 'wantBreakfast', 'wantSnacks', 'weekendMeals', 'snackCount', 'mealsPerDay', 'dietaryRequirement', 'allergies', 'coupon_id', 'discount', 'subTotal', 'total'
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
	];

	protected static function boot ()
	{
		parent::boot();
		self::creating(function (Cart $cart) {
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
}