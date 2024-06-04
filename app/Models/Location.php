<?php

namespace App\Models;

use App\Models\UserServiceLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    public function UserServices()
    {
        return $this->hasMany(UserServiceLocation::class);
    }
}
