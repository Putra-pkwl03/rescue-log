<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    use HasFactory;

    // Sesuaikan nama tabel agar sama persis dengan yang dibuat di Migration
    protected $table = 'pendataans';

    protected $guarded = ['id'];

    public function posko()
    {
        return $this->belongsTo(Posko::class);
    }
}