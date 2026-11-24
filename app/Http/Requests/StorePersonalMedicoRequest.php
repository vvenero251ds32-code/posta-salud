<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\PersonalMedico;
use Illuminate\Validation\Rule;

class StorePersonalMedicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // los permisos por rol llegan en la Guía 05
    }

    public function rules(): array
    {
        return [
            'dni'          => ['required', 'digits:8',
                               'unique:personal_medico,dni'],
            'nombres'      => ['required', 'string', 'max:80'],
            'apellidos'    => ['required', 'string', 'max:80'],
            'especialidad' => ['required',
                               Rule::in(PersonalMedico::ESPECIALIDADES)],
            'colegiatura'  => ['required', 'digits_between:4,6',
                               'unique:personal_medico,colegiatura'],
            'user_id'      => ['nullable', 'unique:personal_medico,user_id',
                               Rule::exists('users', 'id')
                                   ->where('rol', 'personal_medico')],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute admite hasta :max caracteres.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Ya existe un profesional con este DNI.',
            'especialidad.in' => 'Seleccione una especialidad de la lista.',
            'colegiatura.digits_between' =>
                'La colegiatura debe tener de 4 a 6 dígitos.',
            'colegiatura.unique' => 'Esta colegiatura ya está registrada.',
            'user_id.exists' => 'La cuenta elegida no es de personal médico.',
            'user_id.unique' => 'Esa cuenta ya está vinculada a otro profesional.',
        ];
    }

    public function attributes(): array
    {
        return [
            'dni' => 'DNI',
            'colegiatura' => 'N° de colegiatura',
            'user_id' => 'cuenta de usuario',
        ];
    }
}
