<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $casts = [
        'qualification' => 'array',
        'responsibility' => 'array',
    ];


    protected $fillable = [
        'job_title',
        'job_description',
        'job_type',
        'qualification',
        'responsibility',
        'salary',
        'company_id',
        'user_id',
        'end_date',
        'is_active',
    ];


    public function companies()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pinnedUsers()
    {
        return $this->belongsToMany(User::class, 'pinned_jobs', 'job_id', 'user_id');
    }
}
