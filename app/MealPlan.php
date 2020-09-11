<?php

namespace App;

use App\Core\Primitives\Str;
use App\Models\Allergy;
use App\Models\MealPlanImage;
use App\Models\MealPlanItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealPlan extends Model {
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = ['name', 'day', 'launched', 'active', 'type'];
	protected $casts = [
		'launched' => 'bool', 'active' => 'bool'
	];
	protected $hidden = [
		'created_at', 'updated_at', 'deleted_at'
	];

	const AllWeekDays = [
		'Mon' => 'Monday',
		'Tue' => 'Tuesday',
		'Wed' => 'Wednesday',
		'Thu' => 'Thursday',
		'Fri' => 'Friday',
		'Sat' => 'Saturday',
		'Sun' => 'Sunday'
	];

	public function items (): BelongsToMany {
		return $this->belongsToMany(Item::class, 'meal_plan_items')->withPivot('meal_plan_id', 'item_id', 'slab', 'default');
	}

	public function allergies (): BelongsToMany {
		return $this->belongsToMany(Allergy::class, 'meal_plan_allergies')->withPivot(['meal_plan_id', 'allergy_id']);
	}

	public function mealItems (): HasMany {
		return $this->hasMany(MealPlanItem::class);
	}

	public function childrens () {
		return $this->belongsToMany(MealPlan::class, 'item_meal_plan', 'meal_plan_id', 'item_id');
	}

	public function getRatePerItemThreeDaysAttribute () {
		return url('/storage/app/public/items/' . $this->attributes['rate_per_item_three_days']);
	}

	public function images (): HasMany {
		return $this->hasMany(MealPlanImage::class);
	}

	public function prepare (): void {
		$this->quantity = 1;
		$this->total = 0;
		$this->uuid = Str::uuid()->toString();
	}

	public static function classifyCards (): Builder {
		return self::query()->with('items')->whereNotNull('day')->where('active', 1);
	}
}
