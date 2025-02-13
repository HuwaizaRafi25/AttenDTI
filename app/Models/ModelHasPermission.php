<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasPermission extends Model
{
    use HasFactory;
    protected $table = 'model_has_permissions';

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
