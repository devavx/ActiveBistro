<?php

namespace App\Models;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class HowItWork extends Model
{
	protected $fillable = ['title', 'image', 'description', 'active', 'mini_faq'];

	protected $casts = ['active' => 'bool', 'mini_faq' => 'bool'];

	public function setImageAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['image'] = Uploads::instance()->putFile(Directories::HowItWorks, $value);
		} else {
			$this->attributes['image'] = $value;
		}
	}

	public function getImageAttribute ($value): ?string
	{
		return Uploads::existsUrl($this->attributes['image']);
	}
}