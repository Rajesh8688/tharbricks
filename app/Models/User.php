<?php

namespace App\Models;

use App\Models\Review;
use Laravel\Passport\HasApiTokens;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable ,HasPermissionsTrait,HasApiTokens;

    public static $imagePath = 'uploads' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR;
    public static $imageThumbPath = 'uploads' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
    public static $imageUrl = 'uploads/users/';
    public static $imageThumbUrl = 'uploads/users/thumb/';
    public static $imageCompanyUrl = 'uploads/company/';
    public static $imageCompanyThumbUrl = 'uploads/company/thumb/';


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

    protected $guarded = [];

    public function scopeNonSmartOnly($query)
    {
        return $query->where('id', '!=', '1');
    }

    public function scopeBackEndUsers($query)
    {
        return $query->where('back_end_user', 1);
    }
     
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    // Return the user single role
    public function hisRole()
    {
        foreach ($this->roles as $role) {
            return $role->name;
        }
    }

    public function hasRole($role_slug)
    {
        foreach ($this->roles as $role) {
            if ($role->slug == $role_slug) {
                return true;
            }
        }
        return false;
    }

    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_users',
        'user_id', 'lead_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_users',
        'user_id', 'service_id');
    }

    public function vendorDetails(){
        return $this->hasOne(VendorDetails::class,'user_id','id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sumOfRatings()
    {
        return $this->reviews()->sum('rating');
    }
}
