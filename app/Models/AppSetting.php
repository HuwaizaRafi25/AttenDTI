<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_name',
        'app_logo',
        'late_time',
    ];
    protected $casts = [
        'late_time' => 'datetime:H:i:s',
    ];
}
