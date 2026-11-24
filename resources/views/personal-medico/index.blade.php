@extends('layouts.app')

@section('titulo', 'Personal médico')

@section('contenido')
    <hgroup>
        <h1>Personal médico</h1>
        <p>{{ $personal->total() }} profesionales encontrados</p>
    </hgroup>

    <form method="GET" action="{{ route('personal-medico.index') }}">
        <div class="grid">
            <input type="search" name="buscar" value="{{ $buscar }}"
                   placeholder="Apellido, DNI o colegiatura">
            <select name="especialidad">
                <option value="">Todas las especialidades</option>
                @foreach (\App\Models\PersonalMedico::ESPECIALIDADES as $esp)
                    <option value="{{ $esp }}"
                        @selected($especialidad === $esp)>{{ $esp }}</option>
                @endforeach
            </select>
            <select name="estado">
                <option value="activos"
                    @selected($estado === 'activos')>Activos</option>
                <option value="inactivos"
                    @selected($estado === 'inactivos')>Inactivos</option>
                <option value="todos"
                    @selected($estado === 'todos')>Todos</option>
            </select>
            <button type="submit">Filtrar</button>
        </div>
    </form>

    <p><a href="{{ route('personal-medico.create') }}" role="button">
        + Registrar profesional</a></p>

    <table>
        <thead>
            <tr><th>Colegiatura</th><th>Apellidos y nombres</th>
                <th>Especialidad</th><th>Citas</th><th>Estado</th><th></th></tr>
        </thead>
        <tbody>
            @forelse ($personal as $medico)
                <tr>
                    <td>{{ $medico->colegiatura }}</td>
                    <td>{{ $medico->apellidos }}, {{ $medico->nombres }}</td>
                    <td>{{ $medico->especialidad }}</td>
                    <td>{{ $medico->citas_count }}</td>
                    <td><x-estado :activo="$medico->activo" /></td>
                    <td>
                        <a href="{{ route('personal-medico.show', $medico) }}">Ver</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No se encontraron profesionales.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $personal->links() }}
@endsection