<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable =['title','description','thumbnail','type','other_option','active'];

    public function getThumbnailAttribute()
	{  
		return url('/storage/app/public/home-setting/'.$this->attributes['thumbnail']);
	}
}
