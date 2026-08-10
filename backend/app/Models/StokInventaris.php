<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokInventaris extends Model
{
    use HasFactory;

    protected $table = 'stok_inventaris';

    protected $fillable = [
        'nama_barang',
        'kategori',
        'jumlah',
        'satuan',
        'keterangan',
    ];

    // Tambahkan di dalam class StokInventaris
    public function pengiriman()
    {
        return $this->hasMany(PengirimanInventaris::class, 'stok_inventaris_id');
    }
}
