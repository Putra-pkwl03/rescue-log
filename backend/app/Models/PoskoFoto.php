<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoskoFoto extends Model
{
    protected $fillable = ['posko_id', 'path_file'];

    public function posko()
    {
        return $this->belongsTo(Posko::class);
    }
}