<?php

namespace App;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class HomeSetting extends Model
{
	protected $fillable = ['title', 'description', 'thumbnail', 'type', 'other_option', 'active'];

	public function setThumbnailAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['thumbnail'] = Uploads::instance()->putFile(Directories::HomeSliderImages, $value);
		} else {
			$this->attributes['thumbnail'] = $value;
		}
	}

	public function getThumbnailAttribute ($value): ?string
	{
		return Uploads::existsUrl($this->attributes['thumbnail']);
	}
}