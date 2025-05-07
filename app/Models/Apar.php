<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apar extends Model
{
    protected $guarded = [];

    public function cek_apars(): HasMany
    {
        return $this->hasMany(CekApar::class, 'kode_apar', 'kode_apar');
    }
}
