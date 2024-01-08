<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    
    public static $questionOptionPath = 'uploads' . DIRECTORY_SEPARATOR . 'questions' . DIRECTORY_SEPARATOR . 'options' . DIRECTORY_SEPARATOR;
    public static $questionOptionUrl = 'uploads/questions/options/';
}
