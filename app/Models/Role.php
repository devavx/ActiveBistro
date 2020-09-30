<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

	public function user ()
	{
		return $this->hasMany('App\Models\User');
	}
}