<?php

namespace App;

use App\Core\Enums\Common\Directories;
use App\Core\Facades\Uploads;
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

	public function age (): int
	{
		return 1;
	}

	/**
	 * Will always be in centimetres;
	 * @return float
	 */
	public function height (): float
	{
		return $this->height;
	}

	/**
	 * Will always be in kilograms;
	 * @return float
	 */
	public function weight (): float
	{
		return $this->weight;
	}

	public function rmr (): float
	{
		$additive = $this->gender == 'male' ? +5 : -161;
		try {
			return round((99.99 * $this->weight()) + (6.25 * $this->height()) - (4.92 * $this->age() + $additive), 2);
		} catch (\Throwable $e) {
			return 0;
		}
	}

	public function calories (): float
	{
		$activityLevel = empty($this->activity_lavel) ? floatval($this->activity_lavel) : 1;
		return $this->rmr() * $activityLevel;
	}

	public function proteins (): ?string
	{
		return 40;
	}

	public function carbohydrates (): ?string
	{
		return 24;
	}

	public function fats (): ?string
	{
		return 17;
	}
}
