<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{

    protected $table ='responsibility';

    use HasFactory;

    protected $fillable = [
        'responsibility',
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_responsibility');
    }
}
