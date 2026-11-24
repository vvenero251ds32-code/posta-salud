<div class="grid">
    <label>DNI
        <input name="dni" maxlength="8" value="{{ old('dni', $medico->dni) }}"
               @error('dni') aria-invalid="true" @enderror>
        @error('dni') <small>{{ $message }}</small> @enderror
    </label>
    <label>N° de colegiatura
        <input name="colegiatura" maxlength="6"
               value="{{ old('colegiatura', $medico->colegiatura) }}"
               @error('colegiatura') aria-invalid="true" @enderror>
        @error('colegiatura') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Nombres
        <input name="nombres" value="{{ old('nombres', $medico->nombres) }}"
               @error('nombres') aria-invalid="true" @enderror>
        @error('nombres') <small>{{ $message }}</small> @enderror
    </label>
    <label>Apellidos
        <input name="apellidos"
               value="{{ old('apellidos', $medico->apellidos) }}"
               @error('apellidos') aria-invalid="true" @enderror>
        @error('apellidos') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Especialidad
        <select name="especialidad"
                @error('especialidad') aria-invalid="true" @enderror>
            <option value="">Seleccione…</option>
            @foreach (\App\Models\PersonalMedico::ESPECIALIDADES as $esp)
                <option value="{{ $esp }}"
                    @selected(old('especialidad',
                                  $medico->especialidad) === $esp)>
                    {{ $esp }}</option>
            @endforeach
        </select>
        @error('especialidad') <small>{{ $message }}</small> @enderror
    </label>
    <label>Cuenta de usuario (opcional)
        <select name="user_id" @error('user_id') aria-invalid="true" @enderror>
            <option value="">Sin cuenta</option>
            @foreach ($cuentas as $cuenta)
                <option value="{{ $cuenta->id }}"
                    @selected(old('user_id', $medico->user_id) == $cuenta->id)>
                    {{ $cuenta->name }} ({{ $cuenta->email }})</option>
            @endforeach
        </select>
        @error('user_id') <small>{{ $message }}</small> @enderror
    </label>
</div>