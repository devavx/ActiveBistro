<?php

namespace App;

use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'type', 'other_option', 'active'];

    public function getThumbnailAttribute()
    {
        return Uploads::existsUrl($this->attributes['thumbnail']);
    }
}