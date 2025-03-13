<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\FaceUser;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'period_start_date',    // Tanggal mulai periode
        'period_end_date',      // Tanggal mulai periode
    ];

    protected $fillable = [
        'identity_number',          // Tambahkan identity_number jika ingin memungkinkan mass assignment
        'username',      // Username pengguna
        'itb_account',   // Akun ITB pengguna
        'email',         // Email pengguna
        'phone',         // Nomor telepon
        'password',      // Password pengguna
        'full_name',     // Nama lengkap
        'gender',        // Gender
        'address',       // Alamat pengguna
        'profile_pic',   // Gambar profil
        'institution',   // Nama institusi
        'placement_id',  // ID lokasi penempatan
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, "model_has_roles", "model_id", "role_id");
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "model_has_permissions", "model_id", "permission_id");
    }

    public function isOnline()
    {
        return $this->last_seen && $this->last_seen->gt(Carbon::now()->subMinutes(1));
    }

    public function placement()
    {
        return $this->belongsTo(Location::class, 'placement_id');
    }

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }

    public function pinned()
    {
        return $this->belongsToMany(Jobs::class, 'pinned_jobs', 'user_id', 'job_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function approver(){
        return $this->hasMany(Attendance::class, 'approver_id');
    }

    public function faceUser()
    {
        return $this->hasOne(FaceUser::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }
}
