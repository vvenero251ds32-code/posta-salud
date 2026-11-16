<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni', 'nombres', 'apellidos', 'fecha_nacimiento',
        'sexo', 'telefono', 'direccion',
    ];

    protected function casts(): array
    {
        return ['fecha_nacimiento' => 'date'];
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    // Historia clínica: atenciones del paciente a través de sus citas
    public function atenciones(): HasManyThrough
    {
        return $this->hasManyThrough(Atencion::class, Cita::class);
    }
}