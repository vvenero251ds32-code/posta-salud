@props(['activo'])

@if ($activo)
    <mark class="estado-activo">Activo</mark>
@else
    <mark class="estado-inactivo">Inactivo</mark>
@endif