<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // ==========================================
    // LOCAL SCOPES (Penambahan untuk Fix Error)
    // ==========================================

    /**
     * Scope untuk menyaring Posko Komando Utama
     */
    public function scopeKomando($query)
    {
        return $query->where('tipe_posko', 'komando');
    }

    /**
     * Scope untuk menyaring Sub-Posko / Posko Lapangan
     */
    public function scopeSubPosko($query)
    {
        return $query->where('tipe_posko', 'posko_kecil'); 
    }

    // ==========================================
    // RELASI DATABASE
    // ==========================================

    public function bpbd()
    {
        return $this->belongsTo(Bpbd::class, 'bpbd_id');
    }

    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id');
    }

    public function parent()
    {
        return $this->belongsTo(Posko::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Posko::class, 'parent_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'posko_id');
    }

    public function fotos()
    {
        return $this->hasMany(PoskoFoto::class, 'posko_id');
    }

    // ==========================================
    // BOOT & HELPER FUNCTIONS
    // ==========================================

    protected static function booted()
    {
        static::creating(function ($posko) {
            if (empty($posko->kode_undangan)) {
                $posko->kode_undangan = self::generateKodeUndangan();
            }
        });
    }

    /**
     * Method untuk generate kode undangan unik.
     */
    public static function generateKodeUndangan(): string
    {
        do {
            // Contoh format: PSK-A8F2K9 (Unik & mudah dibaca)
            $code = 'PSK-' . strtoupper(Str::random(6));
        } while (self::where('kode_undangan', $code)->exists());

        return $code;
    }
}