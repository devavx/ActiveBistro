<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name','first_name','last_name','dob','gender','phone','gender_info','role_id', 'email', 'password','click_to_verify','about','user_targert_weight','user_weight','user_height','address','profile_image'
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

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function getProfileImageAttribute(){
        if (!empty($this->attributes['profile_image'])) { 
            return asset('uploads/avatars/'.$this->attributes['profile_image']);
        }
        return $this->attributes['profile_image'] ;
    }
}
