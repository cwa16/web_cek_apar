<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CekRumahApar extends Model
{
    protected $guarded = [];

    public function rumahApar()
    {
        return $this->belongsTo(RumahApar::class, 'rumah_apar_id', 'rumah_apar_id');
    }
}
