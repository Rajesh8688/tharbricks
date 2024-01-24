<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


     public function service(){
          return $this->belongsTo(Service::class);
     }

    public function options(){
        return $this->hasMany(QuestionOption::class);
   }
}
