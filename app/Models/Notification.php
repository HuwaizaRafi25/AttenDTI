<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',       // Pengirim notifikasi
        'receiver',     // Penerima notifikasi
        'icon',         // Ikon notifikasi
        'message',      // Pesan notifikasi
        'route',        // Rute notifikasi
        'status_baca',  // Status baca notifikasi
    ];
}
