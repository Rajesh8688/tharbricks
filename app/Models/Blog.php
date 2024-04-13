<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public static $imagePath = 'uploads' . DIRECTORY_SEPARATOR . 'blogs' . DIRECTORY_SEPARATOR;
    public static $imageUrl = 'uploads/blogs/';

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
