<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    protected $table = 'job_type';

    protected $fillable = [
        'job_type_name',
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'pivot_job_type', 'job_type_id', 'job_id');
    }
}
