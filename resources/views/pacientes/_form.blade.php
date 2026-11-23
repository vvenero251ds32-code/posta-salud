<label>DNI
    <input name="dni" value="{{ old('dni', $paciente->dni) }}" maxlength="8"
           @error('dni') aria-invalid="true" @enderror>
    @error('dni') <small>{{ $message }}</small> @enderror
</label>

<div class="grid">
    <label>Nombres
        <input name="nombres" value="{{ old('nombres', $paciente->nombres) }}"
               @error('nombres') aria-invalid="true" @enderror>
        @error('nombres') <small>{{ $message }}</small> @enderror
    </label>
    <label>Apellidos
        <input name="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}"
               @error('apellidos') aria-invalid="true" @enderror>
        @error('apellidos') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Fecha de nacimiento
        <input type="date" name="fecha_nacimiento"
               value="{{ old('fecha_nacimiento',
                             $paciente->fecha_nacimiento?->format('Y-m-d')) }}"
               @error('fecha_nacimiento') aria-invalid="true" @enderror>
        @error('fecha_nacimiento') <small>{{ $message }}</small> @enderror
    </label>
    <label>Sexo
        <select name="sexo" @error('sexo') aria-invalid="true" @enderror>
            <option value="">Seleccione…</option>
            <option value="F" @selected(old('sexo', $paciente->sexo) === 'F')>
                Femenino</option>
            <option value="M" @selected(old('sexo', $paciente->sexo) === 'M')>
                Masculino</option>
        </select>
        @error('sexo') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Celular
        <input name="telefono" maxlength="9"
               value="{{ old('telefono', $paciente->telefono) }}"
               @error('telefono') aria-invalid="true" @enderror>
        @error('telefono') <small>{{ $message }}</small> @enderror
    </label>
    <label>Dirección
        <input name="direccion" value="{{ old('direccion', $paciente->direccion) }}"
               @error('direccion') aria-invalid="true" @enderror>
        @error('direccion') <small>{{ $message }}</small> @enderror
    </label>
</div>