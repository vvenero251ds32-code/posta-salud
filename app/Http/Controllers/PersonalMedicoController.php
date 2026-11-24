<?php

namespace App\Http\Controllers;

use App\Models\PersonalMedico;
use App\Http\Requests\StorePersonalMedicoRequest;
use App\Http\Requests\UpdatePersonalMedicoRequest;
use Illuminate\Http\Request;

class PersonalMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar       = trim($request->input('buscar', ''));
        $especialidad = $request->input('especialidad');
        $estado       = $request->input('estado', 'activos');

        $personal = PersonalMedico::query()
            ->deEspecialidad($especialidad)
            ->when($estado === 'activos', fn ($q) => $q->activos())
            ->when($estado === 'inactivos', fn ($q) => $q->where('activo', false))
            ->when($buscar, function ($q, $buscar) {
                $q->where(function ($q) use ($buscar) {
                    $q->where('apellidos', 'ilike', "%$buscar%")
                      ->orWhere('dni', 'like', "$buscar%")
                      ->orWhere('colegiatura', 'like', "$buscar%");
                });
            })
            ->withCount('citas')
            ->orderBy('apellidos')
            ->paginate(10)
            ->withQueryString();

        return view('personal-medico.index',
            compact('personal', 'buscar', 'especialidad', 'estado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalMedicoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalMedico $personalMedico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonalMedico $personalMedico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonalMedicoRequest $request, PersonalMedico $personalMedico)
    {
        //
    }
    
}
