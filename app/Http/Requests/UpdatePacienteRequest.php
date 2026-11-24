<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdatePacienteRequest extends StorePacienteRequest
{
    public function rules(): array
    {
        $reglas = parent::rules();
        $id = $this->route('paciente');

        $reglas['dni'] = ['required', 'digits:8',
            Rule::unique('pacientes', 'dni')->ignore($id)];

        return $reglas;
    }
}