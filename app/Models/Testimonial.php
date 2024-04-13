<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public static $imagePath = 'uploads' . DIRECTORY_SEPARATOR . 'testimonials' . DIRECTORY_SEPARATOR;
    public static $imageUrl = 'uploads/testimonials/';

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

}
 