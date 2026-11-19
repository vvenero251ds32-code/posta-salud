<?php

namespace Database\Seeders;

use App\Models\PersonalMedico;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonalMedicoSeeder extends Seeder
{
    public function run(): void
    {
        // La médica vinculada al usuario medico@posta.test
        $usuario = User::where('email', 'medico@posta.test')->first();
        PersonalMedico::factory()->create([
            'user_id'      => $usuario->id,
            'nombres'      => 'Rosa',
            'apellidos'    => 'Huamán Quispe',
            'especialidad' => 'Medicina general',
        ]);

        PersonalMedico::factory()->count(4)->create();
        PersonalMedico::factory()->inactivo()->create(); // para probar RN04
    }
}