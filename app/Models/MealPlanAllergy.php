<?php

namespace App\Models;

use App\MealPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MealPlanAllergy extends Model {
	protected $fillable = [
		'meal_plan_id', 'allergy_id'
	];

	public function mealPlan (): BelongsTo {
		return $this->belongsTo(MealPlan::class);
	}

	public function allergy (): BelongsTo {
		return $this->belongsTo(Allergy::class);
	}
}
