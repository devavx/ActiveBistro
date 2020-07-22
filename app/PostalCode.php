<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
   protected $fillable = ['name','description','active'];
}
