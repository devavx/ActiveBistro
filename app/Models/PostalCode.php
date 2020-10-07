<?php

namespace App\Models;

use App\Core\Traits\ActiveStatus;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
	use ActiveStatus;

	protected $fillable = ['name', 'description', 'active'];

	protected $casts = ['active' => 'bool'];
}
