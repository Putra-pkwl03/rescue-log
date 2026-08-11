<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PengajuanKebutuhanDetail; // Mengatasi garis merah pada IDE

class PengajuanKebutuhan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_kebutuhan';

    protected $fillable = [
        'kode_pengajuan',
        'posko_id',
        'bencana_id',
        'user_id',
        'tanggal_pengajuan',
        'status',
        'catatan_komando',
    ];

    public function details()
    {
        return $this->hasMany(PengajuanKebutuhanDetail::class, 'pengajuan_kebutuhan_id');
    }

    public function posko()
    {
        return $this->belongsTo(Posko::class, 'posko_id');
    }

    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}