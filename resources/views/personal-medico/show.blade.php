@extends('layouts.app')

@section('titulo', 'Personal médico')

@section('contenido')
    <hgroup>
        <h1>{{ $medico->apellidos }}, {{ $medico->nombres }}</h1>
        <p>{{ $medico->especialidad }} ·
           <x-estado :activo="$medico->activo" /></p>
    </hgroup>

    <article>
        <p><strong>DNI:</strong> {{ $medico->dni }}</p>
        <p><strong>N° de colegiatura:</strong> {{ $medico->colegiatura }}</p>
        <p><strong>Cuenta de usuario:</strong>
           {{ $medico->user?->email ?? 'Sin cuenta vinculada' }}</p>
    </article>

    <h2>Próximas citas</h2>
    @forelse ($proximas as $cita)
        <p>{{ $cita->fecha_hora->format('d/m/Y H:i') }} ·
           {{ $cita->paciente->apellidos }}, {{ $cita->paciente->nombres }} ·
           {{ $cita->estado }}</p>
    @empty
        <p>No tiene citas próximas.</p>
    @endforelse

    <div class="acciones">
        <a href="{{ route('personal-medico.edit', $medico) }}"
           role="button">Editar</a>
        <a href="{{ route('personal-medico.index') }}">Volver al listado</a>
    </div>
@endsection