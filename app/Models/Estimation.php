<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    public static $imagePath = 'uploads' . DIRECTORY_SEPARATOR . 'estimation' . DIRECTORY_SEPARATOR;
    use HasFactory;
}
