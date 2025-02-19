<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date',
        'start_date',
        'end_date',
        'priority',
    ];

    protected $casts = [
        'due_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string',
        'priority' => 'string',
    ];

    protected $table = 'tasks';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
