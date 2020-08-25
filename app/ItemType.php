<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemType extends Model
{
    protected $fillable = ['name', 'description', 'active'];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
