<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'title', 'active'
	];
	protected $casts = [
		'active' => 'bool'
	];

	public function faqs (): HasMany
	{
		return $this->hasMany(Faq::class);
	}
}
