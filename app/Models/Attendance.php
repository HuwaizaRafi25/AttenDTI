<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'approver_id',
        'location_id',
        'attendance',
        'status',
        'note',
    ];
    protected $casts = [
        'check_in' => 'datetime:H:i:s',
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
