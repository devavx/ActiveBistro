<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlanItem extends Model
{
    protected $table = "item_meal_plan";
    protected $fillable = [
        'item_id', 'meal_plan_id'
    ];
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}
