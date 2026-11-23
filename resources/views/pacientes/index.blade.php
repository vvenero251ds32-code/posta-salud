@extends('layouts.app')

@section('titulo', 'Pacientes')

@section('contenido')
    <hgroup>
        <h1>Pacientes</h1>
        <p>{{ $pacientes->total() }} pacientes encontrados</p>
    </hgroup>

    <form method="GET" action="{{ route('pacientes.index') }}" role="search">
        <input type="search" name="buscar" value="{{ $buscar }}"
               placeholder="Buscar por DNI o apellidos">
        <button type="submit">Buscar</button>
    </form>

    <p>
        <a href="{{ route('pacientes.create') }}" role="button">+ Registrar paciente</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>DNI</th><th>Apellidos y nombres</th><th>Edad</th>
                <th>Teléfono</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->dni }}</td>
                    <td>{{ $paciente->apellidos }}, {{ $paciente->nombres }}</td>
                    <td>{{ $paciente->fecha_nacimiento->age }} años</td>
                    <td>{{ $paciente->telefono ?? '—' }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $paciente) }}">Ver</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No se encontraron pacientes.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $pacientes->links('pagination::simple-tailwind') }}
@endsection