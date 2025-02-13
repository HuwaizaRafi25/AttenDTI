<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',     // Nama lokasi
        'campus',   // Kampus lokasi
        'address',  // Letak lokasi
        'email_address', // Email
        'latitude', // Garis lintang
        'longitude',// Garis bujur
        'radius',   // Radius lokasi
        'pic'       // Foto lokasi
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'placement_id');
    }
}
