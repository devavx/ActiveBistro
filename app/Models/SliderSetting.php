<?php

namespace App\Models;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class SliderSetting extends Model
{
	protected $fillable = ['title', 'description', 'thumbnail', 'thumbnail_type', 'active'];

	public function setThumbnailAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['thumbnail'] = Uploads::instance()->putFile(Directories::HomeSliderImages, $value);
		} else {
			$this->attributes['thumbnail'] = $value;
		}
	}

	public function getThumbnailAttribute ()
	{
		return Uploads::existsUrl($this->attributes['thumbnail']);
	}
}