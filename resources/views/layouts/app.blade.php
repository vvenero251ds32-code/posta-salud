<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Inicio') · {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <header class="container">
        <nav>
            <ul><li><strong>{{ config('app.name') }}</strong></li></ul>
            <ul>
                <li><a href="{{ route('inicio') }}">Inicio</a></li>
                <li><a href="#">Pacientes</a></li>
                <li><a href="#">Personal médico</a></li>
                <li><a href="#">Citas</a></li>
                <li><a href="#">Atenciones</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        @yield('contenido')
    </main>
    <footer class="container">
        <small>DSI406 · Tecnología Backend · IES Túpac Amaru</small>
    </footer>
</body>
</html>