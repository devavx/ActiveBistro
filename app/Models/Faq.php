<?php

namespace App\Models;

use App\Core\Primitives\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
	protected $fillable = ['faq_title', 'faq_description', 'active', 'faq_category_id'];

	public function category (): BelongsTo
	{
		return $this->belongsTo(FaqCategory::class, 'faq_category_id')->withDefault(function (FaqCategory $category) {
			$category->title = Str::Empty;
			$category->active = 1;
		});
	}
}