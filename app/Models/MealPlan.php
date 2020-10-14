<?php

namespace App\Models;

use App\Core\Primitives\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class MealPlan extends Model
{
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

	public function items (): BelongsToMany
	{
		return $this->belongsToMany(Item::class, 'meal_plan_items')->withPivot('meal_plan_id', 'item_id', 'slab', 'default');
	}

	public function ingredients (): Collection
	{
		$ingredients = new Collection();
		$this->items->each(function (Item $item) use (&$ingredients) {
			$ingredients = $ingredients->merge($item->ingredients);
		});
		return $ingredients;
	}

	public function allergies (): BelongsToMany
	{
		return $this->belongsToMany(Allergy::class, 'meal_plan_allergies');
	}

	public function allergyList (): Collection
	{
		$allergiesCollection = $this->allergies;
		$list = new Collection();
		foreach ($allergiesCollection as $item) {
			$list->push([
				'id' => $item->id,
				'name' - $item->name
			]);
		}
		return $list;
	}

	public function mealItems (): HasMany
	{
		return $this->hasMany(MealPlanItem::class);
	}

	public function images (): HasMany
	{
		return $this->hasMany(MealPlanImage::class);
	}

	public function prepare (): void
	{
		$this->quantity = 1;
		$this->total = 0;
		$this->allergic = false;
		$this->uuid = Str::uuid()->toString();
	}

	public static function classifyCards (): Builder
	{
		return self::query()->with('items', 'allergies')->whereNotNull('day')->where('active', 1);
	}
}
