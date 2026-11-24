@extends('layouts.app')

@section('titulo', 'Editar profesional')

@section('contenido')
    <h1>Editar profesional</h1>

    <form method="POST" novalidate
          action="{{ route('personal-medico.update', $medico) }}">
        @csrf
        @method('PUT')
        @include('personal-medico._form')

        <div class="acciones">
            <button type="submit">Guardar cambios</button>
            <a href="{{ route('personal-medico.show', $medico) }}">Cancelar</a>
        </div>
    </form>
@endsection