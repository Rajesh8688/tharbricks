<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public static $imagePath = 'uploads' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR;
    public static $imageIconPath = 'uploads' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR . 'icons' . DIRECTORY_SEPARATOR;
    public static $imageUrl = 'uploads/categories/';
    public static $imageIconUrl = 'uploads/categories/icons/';

}
