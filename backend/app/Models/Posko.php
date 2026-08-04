<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',
    ];

    // Relasi: Posko Komando terikat pada 1 BPBD
    public function bpbd()
    {
        return $this->belongsTo(Bpbd::class, 'bpbd_id');
    }

    // Relasi: Posko Lapangan Kecil terikat pada 1 Kejadian Bencana
    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id');
    }

    // Relasi Self-Referencing: Posko Kecil merujuk ke 1 Posko Komando
    public function parent()
    {
        return $this->belongsTo(Posko::class, 'parent_id');
    }

    // Relasi Self-Referencing: Posko Komando menaungi banyak Posko Kecil
    public function children()
    {
        return $this->hasMany(Posko::class, 'parent_id');
    }

    // Relasi: Posko menampung banyak Petugas/User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}