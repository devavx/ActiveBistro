<?php

namespace App;

use App\Models\MealPlanImage;
use App\Models\MealPlanItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealPlan extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'day', 'launched', 'active'];

    const AllWeekDays = [
        'Mon' => 'Monday',
        'Tue' => 'Tuesday',
        'Wed' => 'Wednesday',
        'Thu' => 'Thursday',
        'Fri' => 'Friday',
        'Sat' => 'Saturday',
        'Sun' => 'Sunday'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function mealItems(): HasMany
    {
        return $this->hasMany(MealPlanItem::class);
    }

    public function childrens()
    {
        return $this->belongsToMany(MealPlan::class, 'item_meal_plan', 'meal_plan_id', 'item_id');
    }

    public function getRatePerItemThreeDaysAttribute()
    {
        return url('/storage/app/public/items/' . $this->attributes['rate_per_item_three_days']);
    }

    public function images(): HasMany
    {
        return $this->hasMany(MealPlanImage::class);
    }
}
