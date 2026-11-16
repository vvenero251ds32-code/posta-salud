<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Atencion extends Model
{
    use HasFactory;

    protected $table = 'atenciones';

    protected $fillable = ['cita_id', 'diagnostico', 'tratamiento', 'observaciones'];

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }
}