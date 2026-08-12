<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PengajuanKebutuhan;
use App\Models\Armada;
use App\Models\Posko;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';
    protected $guarded = ['id'];

    /**
     * Relasi ke Header Pengajuan Kebutuhan
     */
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanKebutuhan::class, 'pengajuan_kebutuhan_id');
    }

    /**
     * Relasi ke Armada / Kendaraan
     */
    public function armada(): BelongsTo
    {
        return $this->belongsTo(Armada::class, 'armada_id');
    }

    /**
     * Relasi ke Posko Asal (Posko Komando)
     */
    public function poskoAsal(): BelongsTo
    {
        return $this->belongsTo(Posko::class, 'posko_asal_id');
    }

    /**
     * Relasi ke Posko Tujuan (Posko Kecil)
     */
    public function poskoTujuan(): BelongsTo
    {
        return $this->belongsTo(Posko::class, 'posko_tujuan_id');
    }
}
