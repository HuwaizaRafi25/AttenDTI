<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';

    protected $fillable = [
        'job_title',
        'company_name',
        'company_address',
        'company_email',
        'job_description',
        'location',
        'salary',
        'is_active',
    ];

    public function jobTypes()
    {
        return $this->belongsToMany(JobType::class, 'pivot_job_type', 'job_id', 'job_type_id');
    }

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class, 'pivot_qualification');
    }

    public function responsibilities()
    {
        return $this->belongsToMany(Responsibility::class, 'pivot_responsibility');
    }

    public function pinnedByUsers()
    {
        return $this->belongsToMany(User::class, 'pinned_job');
    }
}
