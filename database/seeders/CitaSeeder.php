<?php

namespace Database\Seeders;

use App\Models\Atencion;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\PersonalMedico;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $pacientes = Paciente::pluck('id');
        $turnos = ['08:00', '08:30', '09:00', '09:30',
                   '10:00', '10:30', '11:00', '11:30'];
        $ocupados = []; // "paciente|hora" ya usados

        foreach (PersonalMedico::where('activo', true)->get() as $medico) {
            foreach (range(-3, 3) as $dia) {
                $fecha = today()->addDays($dia);
                if ($fecha->isWeekend()) {
                    continue;
                }
                foreach ($turnos as $hora) {
                    if (fake()->boolean(40)) {
                        continue; // deja algunos turnos libres
                    }
                    $inicio = $fecha->copy()->setTimeFromTimeString($hora);
                    do {
                        $pacienteId = $pacientes->random();
                    } while (isset($ocupados["$pacienteId|$inicio"]));
                    $ocupados["$pacienteId|$inicio"] = true;

                    $estado = $inicio->isPast()
                        ? (fake()->boolean(85) ? 'atendida' : 'cancelada')
                        : fake()->randomElement(['pendiente', 'confirmada']);

                    $cita = Cita::create([
                        'paciente_id'        => $pacienteId,
                        'personal_medico_id' => $medico->id,
                        'fecha_hora'         => $inicio,
                        'fecha_hora_fin'     => $inicio->copy()->addMinutes(30),
                        'motivo'             => fake()->randomElement([
                            'Consulta general', 'Control prenatal', 'Fiebre y tos',
                            'Dolor abdominal', 'Control de presión arterial',
                            'Dolor de muelas',
                        ]),
                        'estado'             => $estado,
                    ]);

                    if ($estado === 'atendida') {
                        Atencion::factory()->create(['cita_id' => $cita->id]);
                    }
                }
            }
        }
    }
}