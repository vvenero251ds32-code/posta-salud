# Pruebas unitarias del módulo Pacientes (Guía 03)

Fecha: 23/11/2026 · Responsable: Vanessa Emma Venero La Rosa

| Caso | Resultado | Observación |
|------|-----------|-------------|
| CP01 | OK | Listado muestra 10 registros por página y total de 40 pacientes |
| CP02 | OK | Búsqueda exacta por DNI devuelve un único registro |
| CP03 | OK | Búsqueda insensible a mayúsculas (`ilike`) filtra coincidencias |
| CP04 | OK | `withQueryString()` conserva el parámetro `?buscar=` al paginar |
| CP05 | OK | Validación muestra errores obligatorios en español |
| CP06 | OK | Rechaza DNI de 7 dígitos y conserva valores con `old()` |
| CP07 | OK | Regla `unique` bloquea DNI duplicado (RN01) |
| CP08 | OK | Rechaza fechas posteriores a hoy (`before_or_equal:today`) |
| CP09 | OK | Valida que el celular inicie con 9 (`starts_with:9`) |
| CP10 | OK | Crea paciente, redirige a ficha con aviso verde y total sube a 41 |
| CP11 | OK | Permite actualizar celular ignorando DNI propio (`Rule::unique()->ignore()`) |
| CP12 | OK | Impide asignar el DNI de otro paciente existente |
| CP13 | OK | Bloquea borrado de paciente con citas y muestra aviso rojo (RF07) |
| CP14 | OK | Elimina paciente sin citas con aviso verde y total regresa a 40 |
| CP15 | OK | Route Model Binding responde 404 ante ID inexistente |