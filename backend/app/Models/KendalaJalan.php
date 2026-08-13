<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendalaJalan extends Model
{
    use HasFactory;

    protected $table = 'kendala_jalans';

    protected $guarded = ['id'];

    protected $casts = [
        'latitude'  => 'double',
        'longitude' => 'double',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke User / Petugas Posko yang melaporkan kendala ini
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope untuk memfilter hanya kendala yang masih aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}