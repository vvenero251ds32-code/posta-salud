<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdatePacienteRequest extends StorePacienteRequest
{
    public function rules(): array
    {
        $reglas = parent::rules();

        $reglas['dni'] = [
            'required', 'digits:8',
            Rule::unique('pacientes', 'dni')->ignore($this->route('paciente')),
        ];

        return $reglas;
    }
}