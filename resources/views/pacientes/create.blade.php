@extends('layouts.app')

@section('titulo', 'Registrar paciente')

@section('contenido')
    <h1>Registrar paciente</h1>

    <form method="POST" action="{{ route('pacientes.store') }}" novalidate>
        @csrf
        @include('pacientes._form')

        <div class="acciones">
            <button type="submit">Guardar</button>
            <a href="{{ route('pacientes.index') }}">Cancelar</a>
        </div>
    </form>
@endsection