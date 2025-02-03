<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'activity_log';
    protected $fillable = [
        "causer_id",
        "activity_type",
        "activity_details",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
