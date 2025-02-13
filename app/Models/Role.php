<?php

namespace App\Models;

use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Model as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasPermissions;
    protected $fillable = ['name', 'guard_name'];

    public function users(){
        return $this->belongsToMany(User::class,'model_has_permission', 'permission_id', 'user_id');
    }
}
