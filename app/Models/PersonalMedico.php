<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonalMedico extends Model
{
    use HasFactory;

    protected $table = 'personal_medico';

    protected $fillable = [
        'user_id', 'dni', 'nombres', 'apellidos',
        'especialidad', 'colegiatura', 'activo',
    ];

    public const ESPECIALIDADES = [
        'Medicina general', 'Obstetricia', 'Enfermería',
        'Odontología', 'Pediatría',
    ];

    protected function casts(): array
    {
        return ['activo' => 'boolean'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}