<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'token', 'created_at',
    ];
    public $primaryKey = 'email';
    protected $keyType ='string';
    public $incrementing = false;
    public $timestamps = false;

}
