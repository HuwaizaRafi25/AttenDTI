<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'company_email',
    ];

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function responsibilities()
    {
        return $this->hasMany(Responbility::class);
    }
}
