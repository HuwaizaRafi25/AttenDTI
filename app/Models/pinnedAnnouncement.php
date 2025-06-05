<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinnedAnnouncement extends Model
{
    use HasFactory;

    protected $table = 'pinned_announcement';
    protected $fillable = [
        'announcement_id',
        'user_id',
        'is_pinned',
    ];
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
