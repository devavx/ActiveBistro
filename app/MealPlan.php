<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealPlan extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];
   protected $fillable = ['name','no_of_days','rate_per_item','rate_per_item_three_days','meal_in_two_days','meal_in_three_days'];

   	const AllWeekDays = [
   		'Mon'=>'Monday',
   		'Tue'=>'Tuesday',
   		'Wed'=>'Wednesday',
   		'Thu'=>'Thursday',
   		'Fri'=>'Friday',
   		'Sat'=>'Saturday',
   		'Sun'=>'Sunday'
   	];

   	public function items()
	{
		return $this->belongsToMany("App\Item");
	}
    public function childrens()
	{
		return $this->belongsToMany(MealPlan::class, 'item_meal_plan','meal_plan_id','item_id');
	} 
}
