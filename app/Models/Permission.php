<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as spatiePermission;
use Spatie\Permission\Traits\HasRoles;

class Permission extends spatiePermission
{
    use HasRoles;
    protected $fillable = ['name', 'guard_name'];

    public function users(){
        return $this->belongsToMany(User::class,'model_has_role', 'role_id', 'user_id');
    }
}
