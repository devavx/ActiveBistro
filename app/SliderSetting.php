<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderSetting extends Model
{
    protected $fillable = ['title','description','thumbnail','thumbnail_type','active'];

    public function getThumbnailAttribute()
	{  
		return url('/storage/app/public/sliders/'.$this->attributes['thumbnail']);
	}
}
