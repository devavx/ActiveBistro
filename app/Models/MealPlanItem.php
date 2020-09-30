<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MealPlanItem extends Model
{
    protected $fillable = [
        'item_id', 'meal_plan_id', 'slab', 'default'
    ];
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    protected $casts = [
        'default' => 'bool'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}