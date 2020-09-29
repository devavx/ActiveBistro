<?php

namespace App;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use App\Core\Primitives\Str;
use App\Core\Traits\ActiveStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

class Item extends Model
{
	use SoftDeletes;
	use ActiveStatus;

	protected $fillable = [
		'name', 'sub_name', 'short_description', 'long_description', 'thumbnail', 'protein', 'calories', 'carbs', 'item_type_id', 'category_id', 'selling_price', 'actual_price', 'active', 'fat'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	public function ingredients ()
	{
		return $this->belongsToMany(Ingredient::class);
	}

	public function type (): BelongsTo
	{
		return $this->belongsTo(ItemType::class)->withDefault(function (ItemType $type) {
			return $type->name = Str::Empty;
		});
	}

	public function category (): BelongsTo
	{
		return $this->belongsTo(Category::class)->withDefault(function (Category $category) {
			return $category->name = Str::Empty;
		});
	}

	public function setThumbnailAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['thumbnail'] = Uploads::instance()->putFile(Directories::ItemImages, $value);
		} else {
			$this->attributes['thumbnail'] = $value;
		}
	}

	public function getThumbnailAttribute ($value): ?string
	{
		return Uploads::existsUrl($value);
	}

	public function meals (): BelongsToMany
	{
		return $this->belongsToMany(MealPlan::class, 'meal_plan_items');
	}

	public function prepare (): void
	{
		$this->quantity = 1;
		$this->total = $this->selling_price;
		$this->uuid = Str::uuid()->toString();
	}
}
