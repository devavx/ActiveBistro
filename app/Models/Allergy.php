<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model {
	protected $fillable = ['name', 'description', 'active'];

	public function activeScope (Builder $query): Builder {
		return $query->where('active', true);
	}
}
