<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $fillable = [
		'code', 'description', 'valid_from', 'valid_until', 'active'
	];
	protected $casts = [
		'active' => 'bool'
	];
}
