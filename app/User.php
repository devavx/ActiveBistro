<?php

namespace App;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'dob', 'gender', 'phone', 'gender_info', 'role_id', 'email', 'password', 'click_to_verify', 'about', 'user_targert_weight', 'user_weight', 'user_height', 'address', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo('App\Role');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function getProfileImageAttribute()
    {
        if (!empty($this->attributes['profile_image'])) {
            return asset('uploads/avatars/' . $this->attributes['profile_image']);
        }
        return $this->attributes['profile_image'];
    }

    public function age(): int
    {
        return 1;
    }

    /**
     * Will always be in centimetres;
     * @return float
     */
    public function height(): float
    {
        return 163;
    }

    /**
     * Will always be in kilograms;
     * @return float
     */
    public function weight(): float
    {
        return 163;
    }

    public function calories(): ?string
    {
        $additive = $this->gender == 'male' ? +5 : -161;
        try {
            return round((99.99 * $this->weight()) + (6.25 * $this->height()) - (4.92 * $this->age() + $additive), 2);
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function proteins(): ?string
    {
        return 40;
    }

    public function carbohydrates(): ?string
    {
        return 24;
    }

    public function fats(): ?string
    {
        return 17;
    }
}
