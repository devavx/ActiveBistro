<?php

namespace App;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
use App\Core\Primitives\Time;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

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
		-1 => 2.4,
		1 => 1.2,
		2 => 1.4,
		3 => 1.6,
		4 => 1.75,
		5 => 2,
		6 => 2.4,
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

	public function calories (): float
	{
		$index = empty($this->activity_lavel) ? intval($this->activity_lavel) : 1;
		if (!isset($this->activityLevel[$index]))
			return $this->metabolicRate() * $this->activityLevel[-1];
		else
			return $this->metabolicRate() * $this->activityLevel[$index];
	}

	public function proteins (): float
	{
		$calories = $this->calories();
		return round((0.2 * $calories) / 4.0, 2);
	}

	public function carbohydrates (): float
	{
		$calories = $this->calories();
		return round((0.3 * $calories) / 9.0, 2);
	}

	public function fats (): float
	{
		$calories = $this->calories();
		return round((0.5 * $calories) / 4.0, 2);
	}
}
