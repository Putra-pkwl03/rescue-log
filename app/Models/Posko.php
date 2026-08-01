<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posko extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_posko',
        'tipe_posko',
        'parent_id',
        'lokasi',
        'kapasitas_maksimal',
        'penanggung_jawab',
        'kontak_hp',
        'status',
    ];

    // Relasi: Posko Kecil punya 1 Posko Komando (Induk)
    public function parent()
    {
        return $this->belongsTo(Posko::class, 'parent_id');
    }

    // Relasi: Posko Komando punya banyak Posko Kecil (Anak)
    public function children()
    {
        return $this->hasMany(Posko::class, 'parent_id');
    }

    // Relasi: Posko punya banyak Petugas (Users)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}