<?php

namespace App;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class BottomSection extends Model
{
	protected $fillable = [
		'content', 'image', 'link', 'link_text'
	];

	public function setImageAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['image'] = Uploads::instance()->putFile(Directories::BottomSectionImages, $value);
		} else {
			$this->attributes['image'] = $value;
		}
	}

	public function getImageAttribute ($value): ?string
	{
		return Uploads::existsUrl($this->attributes['image']);
	}
}
