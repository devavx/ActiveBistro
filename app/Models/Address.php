<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
	protected $fillable = [
		'user_id', 'day', 'address_first_line', 'address_second_line', 'city', 'postcode', 'delivery_notes'
	];

	public function user (): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}