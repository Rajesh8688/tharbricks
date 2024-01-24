<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public static $imagePath = 'uploads' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR;
    public static $imageIconPath = 'uploads' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'icons' . DIRECTORY_SEPARATOR;
    public static $imageUrl = 'uploads/services/';
    public static $imageIconUrl = 'uploads/services/icons/';
}
