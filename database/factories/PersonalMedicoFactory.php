<?php

namespace Database\Factories;

use App\Models\PersonalMedico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PersonalMedico>
 */
class PersonalMedicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni'          => fake()->unique()->numerify('########'),
            'nombres'      => fake()->firstName(),
            'apellidos'    => fake()->lastName() . ' ' . fake()->lastName(),
            'especialidad' => fake()->randomElement([
                'Medicina general', 'Obstetricia', 'Enfermería',
                'Odontología', 'Pediatría',
            ]),
            'colegiatura'  => fake()->unique()->numerify('#####'),
            'activo'       => true,
        ];
    }

    public function inactivo(): static
    {
        return $this->state(fn () => ['activo' => false]);
    }
}
