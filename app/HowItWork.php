<?php

namespace App;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class HowItWork extends Model
{
	protected $fillable = ['title', 'description', 'active'];

	public function setTitleAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['title'] = Uploads::instance()->putFile(Directories::HowItWorks, $value);
		} else {
			$this->attributes['title'] = $value;
		}
	}

	public function getTitleAttribute ($value): ?string
	{
		return Uploads::existsUrl($this->attributes['title']);
	}

	public function setIconAttribute ($value): void
	{
		$this->setTitleAttribute($value);
	}

	public function getIconAttribute ($value): ?string
	{
		return $this->getTitleAttribute($value);
	}
}