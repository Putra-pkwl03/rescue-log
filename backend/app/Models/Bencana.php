<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    // 1. Beri tahu Laravel nama tabel yang benar (tanpa huruf 's')
    protected $table = 'bencana';
    protected $fillable = [
        'jenis_bencana',
        'lokasi_bencana',
        'koordinat_operasional_lat',
        'koordinat_operasional_lng',
        'tanggal_aktivasi',
        'tanggal_selesai',
        'status',
    ];
}