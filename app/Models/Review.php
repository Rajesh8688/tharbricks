<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating', 'comment', 'email', 'lead_id', 'user_id',
    ];

    public function lead(){
        return $this->belongsTo(Lead::class);
    }
}
