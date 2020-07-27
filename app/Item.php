<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable = ['name','sub_name','short_description','long_description','thumbnail','protein','calories','carbs','item_type_id','category_id','selling_price','actual_price','active'];
    public function ingredients()
	{
		return $this->belongsToMany("App\Ingredient");
	}

	public function childrens()
	{
		return $this->belongsToMany(Item::class, 'ingredient_items','item_id','ingredient_id');
	}
	public function getThumnailAttribute()
	{  
		return url('/storage/app/public/items/'.$this->attributes['thumbnail']);
	}
}
