<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id', 'personal_medico_id', 'fecha_hora',
        'fecha_hora_fin', 'motivo', 'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_hora'     => 'datetime',
            'fecha_hora_fin' => 'datetime',
        ];
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function personalMedico(): BelongsTo
    {
        return $this->belongsTo(PersonalMedico::class);
    }

    public function atencion(): HasOne
    {
        return $this->hasOne(Atencion::class);
    }
}