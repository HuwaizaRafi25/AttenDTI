<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $fillable = [
        'created_by',
        'title',
        'text',
        'image_path',
        'link',
        'remove_status',
        'announcement_category_id',
    ];

    protected $casts = [
        'selected_categories' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'announcement_category_id');
    }
    public function pinnedAnnouncements()
    {
        return $this->hasMany(PinnedAnnouncement::class, 'announcement_id');
    }
}
