<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- Tambahkan ini

class Posko extends Model
{
    use HasFactory;

    protected $table = 'poskos';

    protected $fillable = [
        'nama_posko',
        'tipe_posko',
        'parent_id',
        'bpbd_id',
        'bencana_id',
        'kode_undangan',
        'lokasi',
        'latitude',
        'longitude',
        'kapasitas_maksimal',
        'penanggung_jawab',
        'kontak_hp',
        'foto',
        'jumlah_petugas',
        'status',
    ];

    // --- RELASI ---

    // Posko Komando terikat pada 1 BPBD
    public function bpbd()
    {
        return $this->belongsTo(Bpbd::class, 'bpbd_id');
    }

    // Posko Lapangan Kecil terikat pada 1 Kejadian Bencana
    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id');
    }

    // Self-Referencing: Posko Kecil merujuk ke 1 Posko Komando Induk
    public function parent()
    {
        return $this->belongsTo(Posko::class, 'parent_id');
    }

    // Self-Referencing: Posko Komando menaungi banyak Posko Kecil (Sub-Posko)
    public function children()
    {
        return $this->hasMany(Posko::class, 'parent_id');
    }

    // Posko menampung banyak Petugas/User
    public function users()
    {
        return $this->hasMany(User::class, 'posko_id');
    }

    // --- SCOPES (Penyederhanaan Query) ---

    public function scopeKomando($query)
    {
        return $query->where('tipe_posko', 'komando');
    }

    public function scopeSubPosko($query)
    {
        return $query->where('tipe_posko', 'lapangan_kecil');
    }

    // --- HELPER METHOD ---

    /**
     * Generate Kode Undangan unik 8 Karakter (Contoh: PSK-8A2X)
     */
    public static function generateKodeUndangan(): string
    {
        do {
            $kode = 'PSK-' . strtoupper(Str::random(5));
        } while (self::where('kode_undangan', $kode)->exists());

        return $kode;
    }

    // Tambahkan di dalam class Posko
    public function pengirimanInventaris()
    {
        return $this->hasMany(PengirimanInventaris::class, 'posko_id');
    }

    public function fotos()
    {
        return $this->hasMany(PoskoFoto::class, 'posko_id');
    }

    
}
