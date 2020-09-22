<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'description', 'active'];

	public function items (): HasMany
	{
		return $this->hasMany(Item::class);
	}
}
