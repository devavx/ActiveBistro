<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlanItem extends Model
{
    protected $fillable = [
        'item_id', 'meal_plan_id', 'slab'
    ];
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}