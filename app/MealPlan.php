<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealPlan extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];
   protected $fillable = ['name','no_of_days','rate_per_item','rate_per_item_three_days','meal_in_two_days','meal_in_three_days'];
}
