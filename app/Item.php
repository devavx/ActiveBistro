<?php

namespace App;

use App\Core\Primitives\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    protected $fillable = [
        'name', 'sub_name', 'short_description', 'long_description', 'thumbnail', 'protein', 'calories', 'carbs', 'item_type_id', 'category_id', 'selling_price', 'actual_price', 'active'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function ingredients()
    {
        return $this->belongsToMany("App\Ingredient");
    }

    public function childrens()
    {
        return $this->belongsToMany(Item::class, 'ingredient_items', 'item_id', 'ingredient_id');
    }

    public function getThumnailAttribute()
    {
        return url('/storage/app/public/items/' . $this->attributes['thumbnail']);
    }

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(MealPlan::class, 'meal_plan_items');
    }

    public function prepare(): void
    {
        $this->quantity = 1;
        $this->total = $this->selling_price;
        $this->uuid = Str::uuid()->toString();
    }
}
