<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKebutuhanDetail extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_kebutuhan_detail';

    protected $fillable = [
        'pengajuan_kebutuhan_id',
        'barang_id',
        'jumlah_diminta',
        'jumlah_disetujui',
        'satuan',
        'keterangan',
    ];

    public function pengajuanKebutuhan()
    {
        return $this->belongsTo(PengajuanKebutuhan::class, 'pengajuan_kebutuhan_id');
    }

    public function barang()
    {
        return $this->belongsTo(StokInventaris::class, 'barang_id');
    }
}