<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
	protected $fillable = ['name', 'description', 'active'];
}