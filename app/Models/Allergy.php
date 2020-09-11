<?php

namespace App\Models;

use App\MealPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergy extends Model {
	protected $fillable = ['name', 'description', 'active'];

	public function activeScope (Builder $query): Builder {
		return $query->where('active', true);
	}

	public function meals (): BelongsToMany {
		return $this->belongsToMany(MealPlan::class, 'meal_plan_allergies');
	}
}
