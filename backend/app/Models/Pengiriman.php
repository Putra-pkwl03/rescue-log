<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    
    protected $table = 'pengirimans';

    protected $fillable = [
        'kode_pengiriman',
        'pengajuan_id',
        'armada_id',
        'posko_asal_id',
        'posko_tujuan_id',
        'tanggal_kirim',
        'status_pengiriman',
        'catatan_rute',
    ];

    public function pengajuan()
    {
        // PERBAIKAN: Ubah Pengajuan::class menjadi PengajuanKebutuhan::class
        return $this->belongsTo(PengajuanKebutuhan::class, 'pengajuan_id');
    }

    public function armada()
    {
        return $this->belongsTo(Armada::class, 'armada_id');
    }

    public function poskoAsal()
    {
        return $this->belongsTo(Posko::class, 'posko_asal_id');
    }

    public function poskoTujuan()
    {
        return $this->belongsTo(Posko::class, 'posko_tujuan_id');
    }
}