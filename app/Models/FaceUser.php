<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaceUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'face_code'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
