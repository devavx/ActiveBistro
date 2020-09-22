<?php

namespace App;

use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
	protected $fillable = ['faq_title', 'faq_description', 'active'];

	public function category (): BelongsTo
	{
		return $this->belongsTo(FaqCategory::class, 'faq_category_id');
	}
}
