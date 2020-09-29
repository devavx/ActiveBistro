<?php

namespace App;

use App\Core\Traits\ActiveStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
	use SoftDeletes;
	use ActiveStatus;

	protected $fillable = ['name', 'active'];
}
