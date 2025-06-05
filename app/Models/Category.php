<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'announcement_categories';
    protected $fillable = [
        'category_name',
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'category_id');
    }
}
