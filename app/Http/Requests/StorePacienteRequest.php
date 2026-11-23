<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // los permisos por rol llegan en la Guía 05
    }

    public function rules(): array
    {
        return [
            'dni'              => ['required', 'digits:8', 'unique:pacientes,dni'],
            'nombres'          => ['required', 'string', 'max:80'],
            'apellidos'        => ['required', 'string', 'max:80'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:today'],
            'sexo'             => ['required', 'in:M,F'],
            'telefono'         => ['nullable', 'digits:9', 'starts_with:9'],
            'direccion'        => ['nullable', 'string', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute admite hasta :max caracteres.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Ya existe un paciente con este DNI.',
            'fecha_nacimiento.date' => 'Ingrese una fecha válida.',
            'fecha_nacimiento.before_or_equal' =>
                'La fecha de nacimiento no puede ser futura.',
            'sexo.in' => 'Seleccione un sexo válido.',
            'telefono.digits' => 'El celular debe tener 9 dígitos.',
            'telefono.starts_with' => 'El celular debe empezar con 9.',
        ];
    }

    public function attributes(): array
    {
        return [
            'dni'              => 'DNI',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'telefono'         => 'celular',
            'direccion'        => 'dirección',
        ];
    }
}