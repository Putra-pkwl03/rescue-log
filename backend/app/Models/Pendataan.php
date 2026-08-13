<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    use HasFactory;

    // Ubah menjadi 'pendataans' (plural) sesuai konvensi tabel di PostgreSQL
    protected $table = 'pendataans';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posko()
    {
        return $this->belongsTo(Posko::class);
    }
}