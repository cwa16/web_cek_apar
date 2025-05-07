<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CekApar extends Model
{
    protected $guarded = [];

    public function apar() : BelongsTo
    {
        return $this->belongsTo(Apar::class, 'kode_apar', 'kode_apar');

    }
}
