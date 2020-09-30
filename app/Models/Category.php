<?php

namespace App\Models;

use App\Core\Traits\ActiveStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
	use ActiveStatus;

	protected $fillable = ['name', 'description', 'active'];

	public function items (): HasMany
	{
		return $this->hasMany(Item::class);
	}
}
