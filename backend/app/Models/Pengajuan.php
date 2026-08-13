<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke Posko Lapangan (Fix Error RelationNotFoundException)
     */
    public function posko()
    {
        return $this->belongsTo(Posko::class, 'posko_id');
    }

    /**
     * Relasi ke User / Petugas Lapangan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}