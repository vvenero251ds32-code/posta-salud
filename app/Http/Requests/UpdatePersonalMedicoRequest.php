<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdatePersonalMedicoRequest extends StorePersonalMedicoRequest
{
    public function rules(): array
    {
        $reglas = parent::rules();
        $id = $this->route('personalMedico');

        $reglas['dni'] = ['required', 'digits:8',
            Rule::unique('personal_medico', 'dni')->ignore($id)];
        $reglas['colegiatura'] = ['required', 'digits_between:4,6',
            Rule::unique('personal_medico', 'colegiatura')->ignore($id)];
        $reglas['user_id'] = ['nullable',
            Rule::unique('personal_medico', 'user_id')->ignore($id),
            Rule::exists('users', 'id')->where('rol', 'personal_medico')];

        return $reglas;
    }
}