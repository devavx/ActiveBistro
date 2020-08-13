<?php

namespace App;

use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;

class SliderSetting extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'thumbnail_type', 'active'];

    public function getThumbnailAttribute()
    {
        return Uploads::existsUrl($this->attributes['thumbnail']);
    }
}