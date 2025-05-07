<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahApar extends Model
{
    protected $guarded = [];

    // Relasi cek rumah apar
    public function cek_rumah_apars()
    {
        return $this->hasMany(CekRumahApar::class);
    }
}
