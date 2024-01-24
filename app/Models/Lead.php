<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // public function leadsAnswers(){
    //     return $this->hasMany(Lead::class);
    // }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
