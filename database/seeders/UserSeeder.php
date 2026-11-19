<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // La contraseña de los tres usuarios es: password
        User::factory()->create([
            'name'  => 'Administrador',
            'email' => 'admin@posta.test',
            'rol'   => 'administrador',
        ]);
        User::factory()->create([
            'name'  => 'Rosa Huamán',
            'email' => 'medico@posta.test',
            'rol'   => 'personal_medico',
        ]);
        User::factory()->create([
            'name'  => 'Recepción',
            'email' => 'recepcion@posta.test',
            'rol'   => 'recepcion',
        ]);
    }
}