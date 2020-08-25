<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'active'];
    protected $appends = [
        'letty', 'dom'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
