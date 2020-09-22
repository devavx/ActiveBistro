<?php

namespace App;

use App\Core\Enums\Common\ActivityLevel;
use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use App\Core\Primitives\Time;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

	protected $fillable = [
		'name', 'first_name', 'last_name', 'dob', 'gender', 'phone', 'gender_info', 'role_id', 'email', 'password', 'click_to_verify', 'about', 'user_targert_weight', 'user_weight', 'user_height', 'address', 'profile_image'
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected $activityLevel = [
		ActivityLevel::None => 2.4,
		ActivityLevel::Sedentary => 1.2,
		ActivityLevel::Light => 1.4,
		ActivityLevel::Moderate => 1.6,
		ActivityLevel::Very => 1.75,
		ActivityLevel::Extra => 2,
		ActivityLevel::Athlete => 2.4,
	];

	public function role (): BelongsTo
	{
		return $this->belongsTo('App\Role');
	}

	public function cart (): HasOne
	{
		return $this->hasOne(Cart::class);
	}

	public function orders (): HasMany
	{
		return $this->hasMany(Order::class);
	}

	public function addresses (): HasMany
	{
		return $this->hasMany(Address::class);
	}

	public function setProfileImageAttribute ($value): void
	{
		if ($value instanceof UploadedFile) {
			$this->attributes['profile_image'] = Uploads::instance()->putFile(Directories::UserProfileImages, $value);
		} else {
			$this->attributes['profile_image'] = $value;
		}
	}

	public function getProfileImageAttribute ($value): ?string
	{
		return Uploads::existsUrl($this->attributes['profile_image']);
	}

	public function age (bool $asInterval = false)
	{
		$difference = date_diff(date_create($this->dob ?? date('Y-m-d 00:00:00')), date_create(date('Y-m-d 00:00:00')), true);
		if ($asInterval) {
			return $difference;
		}
		if (!$difference) {
			return 0;
		}
		return $difference->y . '.' . $difference->m;
	}

	public function height (): float
	{
		return $this->user_height;
	}

	public function weight (): float
	{
		return $this->user_weight;
	}

	public function additive (): int
	{
		return $this->gender == 'male' ? +5 : -161;
	}

	public function metabolicRate (): float
	{
		$age = Time::intervalToAbsoluteValue($this->age(true));
		try {
			return round(((9.99 * $this->weight()) + (6.25 * $this->height()) - (4.92 * $age)) + $this->additive(), 2);
		} catch (\Throwable $e) {
			return 0;
		}
	}

	public function calories (bool $round = true): float
	{
		$level = empty($this->activity_lavel) ? intval($this->activity_lavel) : ActivityLevel::Sedentary;
		if (!isset($this->activityLevel[$level]))
			$multiplier = $this->activityLevel[ActivityLevel::None];
		else
			$multiplier = $this->activityLevel[$level];
		if (!$round)
			return $this->metabolicRate() * $multiplier;
		else
			return round($this->metabolicRate() * $multiplier, 0);
	}

	public function proteins (): float
	{
		$calories = $this->calories(false);
		return round((0.2 * $calories) / 4.0, 0);
	}

	public function carbohydrates (): float
	{
		$calories = $this->calories(false);
		return round((0.5 * $calories) / 4.0, 0);
	}

	public function fats (): float
	{
		$calories = $this->calories(false);
		return round((0.3 * $calories) / 9.0, 0);
	}

	public function recommendedMealsPerDay (): int
	{
		$level = $this->activity_lavel ?? ActivityLevel::Sedentary;
		switch ($level) {
			case ActivityLevel::Moderate:
				return 3;

			case ActivityLevel::Very:
				return 4;

			case ActivityLevel::Extra:
				return 5;

			case ActivityLevel::Athlete:
				return 6;

			default:
				return 2;
		}
	}
}
