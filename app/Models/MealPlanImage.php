<?php

namespace App\Models;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MealPlanImage extends Model
{
    protected $fillable = [
        'file', 'meal_plan_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function setFileAttribute($value): void
    {
        if ($value instanceof UploadedFile) {
            $this->attributes['file'] = Uploads::instance()->putFile(Directories::MealPlanImages, $value);
        } else {
            $this->attributes['file'] = $value;
        }
    }

    public function getFileAttribute(): ?string
    {
        return Uploads::existsUrl($this->attributes['file']);
    }
}
