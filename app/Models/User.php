<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
        'nisn',          // Tambahkan nisn jika ingin memungkinkan mass assignment
        'username',      // Username pengguna
        'itb_account',   // Akun ITB pengguna
        'email',         // Email pengguna
        'phone',         // Nomor telepon
        'password',      // Password pengguna
        'full_name',     // Nama lengkap
        'address',       // Alamat pengguna
        'profile_pic',   // Gambar profil
        'school',        // Nama sekolah
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

    public function isOnline()
    {
        return $this->last_seen && $this->last_seen->gt(Carbon::now()->subMinutes(1));
    }

    public function placement()
    {
        return $this->belongsTo(Location::class, 'placement_id');
    }
}
