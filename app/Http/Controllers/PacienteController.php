<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use Illuminate\Http\Request;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = trim($request->input('buscar', ''));

        $pacientes = Paciente::query()
            ->when($buscar, function ($consulta, $buscar) {
                $consulta->where('dni', 'like', "$buscar%")
                         ->orWhere('apellidos', 'ilike', "%$buscar%");
            })
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->paginate(10)
            ->withQueryString();

        return view('pacientes.index', compact('pacientes', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('pacientes.create', ['paciente' => new Paciente()]);
    }

    public function store(StorePacienteRequest $request)
    {
        $paciente = Paciente::create($request->validated());

        return redirect()->route('pacientes.show', $paciente)
            ->with('ok', 'Paciente registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    
    public function show(Paciente $paciente)
    {
        $citas = $paciente->citas()
            ->with('personalMedico')
            ->latest('fecha_hora')
            ->take(5)
            ->get();

        return view('pacientes.show', compact('paciente', 'citas'));
    }

    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->validated());

        return redirect()->route('pacientes.show', $paciente)
            ->with('ok', 'Datos del paciente actualizados.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        if ($paciente->citas()->exists()) {
            return back()->with('error',
                'No se puede eliminar: el paciente tiene citas registradas.');
        }

        $paciente->delete();

        return redirect()->route('pacientes.index')
            ->with('ok', 'Paciente eliminado.');
    }
}