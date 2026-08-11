<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PengajuanKebutuhanDetail; // Mengatasi garis merah pada IDE

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'satuan_default',
        'deskripsi',
    ];

    public function pengajuanDetails()
    {
        return $this->hasMany(PengajuanKebutuhanDetail::class, 'barang_id');
    }
}