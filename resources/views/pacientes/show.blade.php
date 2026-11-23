@extends('layouts.app')

@section('titulo', 'Paciente')

@section('contenido')
    <hgroup>
        <h1>{{ $paciente->apellidos }}, {{ $paciente->nombres }}</h1>
        <p>DNI {{ $paciente->dni }} ·
           {{ $paciente->fecha_nacimiento->age }} años</p>
    </hgroup>

    <article>
        <p><strong>Fecha de nacimiento:</strong>
           {{ $paciente->fecha_nacimiento->format('d/m/Y') }}</p>
        <p><strong>Sexo:</strong>
           {{ $paciente->sexo === 'F' ? 'Femenino' : 'Masculino' }}</p>
        <p><strong>Celular:</strong> {{ $paciente->telefono ?? '—' }}</p>
        <p><strong>Dirección:</strong> {{ $paciente->direccion ?? '—' }}</p>
    </article>

    <h2>Últimas citas</h2>
    @forelse ($citas as $cita)
        <p>{{ $cita->fecha_hora->format('d/m/Y H:i') }} ·
           {{ $cita->personalMedico->especialidad }} · {{ $cita->estado }}</p>
    @empty
        <p>Este paciente no tiene citas registradas.</p>
    @endforelse

    <div class="acciones">
        <a href="{{ route('pacientes.edit', $paciente) }}" role="button">Editar</a>
        <a href="{{ route('pacientes.index') }}">Volver al listado</a>
    </div>
@endsection