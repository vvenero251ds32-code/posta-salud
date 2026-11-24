<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\PersonalMedico;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonalMedicoTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_filtra_por_estado_especialidad_y_busqueda(): void
    {
        PersonalMedico::factory()->create([
            'apellidos' => 'Quispe Mamani',
            'especialidad' => 'Pediatría',
            'activo' => true,
        ]);
        PersonalMedico::factory()->create([
            'apellidos' => 'Quispe Ramos',
            'especialidad' => 'Odontología',
            'activo' => true,
        ]);
        PersonalMedico::factory()->inactivo()->create([
            'apellidos' => 'Quispe Inactivo',
            'especialidad' => 'Pediatría',
        ]);

        $respuesta = $this->get('/personal-medico?buscar=Quispe&especialidad=Pediatría&estado=activos');

        $respuesta->assertOk()
            ->assertSee('Quispe Mamani')
            ->assertDontSee('Quispe Ramos')
            ->assertDontSee('Quispe Inactivo');
    }

    public function test_registra_personal_medico_valido_con_cuenta_opcional(): void
    {
        $cuenta = User::factory()->create(['rol' => 'personal_medico']);

        $respuesta = $this->post('/personal-medico', [
            'dni'          => '71234567',
            'nombres'      => 'Carla Sofía',
            'apellidos'    => 'Mendoza Vilca',
            'especialidad' => 'Medicina general',
            'colegiatura'  => '88412',
            'user_id'      => $cuenta->id,
        ]);

        $respuesta->assertRedirect('/personal-medico');
        $this->assertDatabaseHas('personal_medico', [
            'dni'         => '71234567',
            'colegiatura' => '88412',
            'user_id'     => $cuenta->id,
            'activo'      => true,
        ]);
    }

    public function test_rechaza_especialidad_fuera_de_lista_y_cuenta_de_otro_rol(): void
    {
        $pacienteUser = User::factory()->create(['rol' => 'recepcion']);

        $respuesta = $this->post('/personal-medico', [
            'dni'          => '71234568',
            'nombres'      => 'Mario',
            'apellidos'    => 'Torres',
            'especialidad' => 'Cardiología',
            'colegiatura'  => '88413',
            'user_id'      => $pacienteUser->id,
        ]);

        $respuesta->assertSessionHasErrors(['especialidad', 'user_id']);
    }

    public function test_edita_personal_medico_ignorando_su_propio_id(): void
    {
        $medico = PersonalMedico::factory()->create([
            'dni'          => '71234569',
            'colegiatura'  => '88414',
            'especialidad' => 'Enfermería',
        ]);

        $respuesta = $this->put("/personal-medico/{$medico->id}", [
            'dni'          => '71234569',
            'nombres'      => $medico->nombres,
            'apellidos'    => $medico->apellidos,
            'especialidad' => 'Obstetricia',
            'colegiatura'  => '88414',
            'user_id'      => null,
        ]);

        $respuesta->assertRedirect("/personal-medico/{$medico->id}");
        $this->assertDatabaseHas('personal_medico', [
            'id'           => $medico->id,
            'especialidad' => 'Obstetricia',
        ]);
    }

    public function test_baja_logica_desactiva_sin_borrar_y_advierte_citas_proximas(): void
    {
        $medico = PersonalMedico::factory()->create(['activo' => true]);
        $paciente = Paciente::factory()->create();

        Cita::factory()->create([
            'personal_medico_id' => $medico->id,
            'paciente_id'        => $paciente->id,
            'fecha_hora'         => now()->addDay(),
            'estado'             => 'pendiente',
        ]);

        $respuesta = $this->from("/personal-medico/{$medico->id}")
            ->patch("/personal-medico/{$medico->id}/estado");

        $respuesta->assertRedirect("/personal-medico/{$medico->id}")
            ->assertSessionHas('ok', 'Profesional desactivado: ya no recibirá nuevas citas (RN04). Tiene 1 citas próximas por reprogramar.');

        $this->assertDatabaseHas('personal_medico', [
            'id'     => $medico->id,
            'activo' => false,
        ]);
    }
}