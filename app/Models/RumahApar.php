<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahApar extends Model
{
    protected $guarded = [];

    public function cekRumahApars()
    {
        return $this->hasMany(CekRumahApar::class, 'rumah_apar_id', 'rumah_apar_id');
    }
}
