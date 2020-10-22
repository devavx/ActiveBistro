<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
	protected $fillable = [
		'user_id', 'day', 'address_first_line', 'address_second_line', 'city', 'postcode', 'delivery_notes', 'phone', 'area_code'
	];

	public function user (): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function stringify ()
	{
		return sprintf("%s, %s, %s, %s", $this->address_first_line, $this->address_second_line, $this->city, $this->postcode);
	}
}