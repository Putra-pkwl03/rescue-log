<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class RiwayatStok extends Model
{
    use HasFactory;

    protected $table = 'riwayat_stok';

    protected $fillable = [
        'posko_id',
        'barang_id',
        'jenis',
        'jumlah',
        'referensi',
        'referensi_id',
        'keterangan',
    ];

    public function posko()
    {
        return $this->belongsTo(Posko::class, 'posko_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}