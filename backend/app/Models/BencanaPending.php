<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BencanaPending extends Model
{
    protected $fillable = [
        'external_id',
        'sumber_api',
        'jenis_bencana',
        'wilayah',
        'magnitude',
        'kedalaman',
        'potensi',
        'latitude',
        'longitude',
        'waktu_kejadian',
        'raw_payload',
        'status',
    ];

    protected $casts = [
        'raw_payload' => 'array',
        'waktu_kejadian' => 'datetime',
    ];
}