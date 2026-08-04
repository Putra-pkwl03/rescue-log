<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpbd extends Model
{
    protected $table = 'bpbd';

    protected $fillable = [
        'nama_kabupaten_kota',
        'alamat_kantor',
    ];
}