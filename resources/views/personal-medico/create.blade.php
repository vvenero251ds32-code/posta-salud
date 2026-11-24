@extends('layouts.app')

@section('titulo', 'Registrar profesional')

@section('contenido')
    <h1>Registrar profesional</h1>

    <form method="POST" novalidate
          action="{{ route('personal-medico.store') }}">
        @csrf
        @include('personal-medico._form')

        <div class="acciones">
            <button type="submit">Guardar</button>
            <a href="{{ route('personal-medico.index') }}">Cancelar</a>
        </div>
    </form>
@endsection