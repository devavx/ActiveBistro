<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable =['faq_title','faq_description','active'];
}
