# Pruebas funcionales · Guía 04: Módulo Personal Médico

| # | Caso de prueba | Requisito / Regla | Resultado esperado | Estado |
|---|---|---|---|---|
| 1 | Verificar rutas del módulo (`route:list --path=personal-medico`) | RF08, RF09 | 7 rutas con parámetro `{personalMedico}`, sin ruta `destroy` | OK |
| 2 | Listar profesionales activos por defecto | RF08 | Muestra activos con conteo de citas y componente `<x-estado />` verde | OK |
| 3 | Filtrar por estado `Inactivos` y `Todos` | RF08, RF09 | Filtra correctamente y muestra etiqueta roja para inactivos | OK |
| 4 | Combinar filtro de especialidad y búsqueda por texto | RF08 | Agrupa condiciones `OR` sin romper el filtro `AND` de especialidad | OK |
| 5 | Enviar formulario de registro vacío | RF08 | Muestra mensajes de validación en español | OK |
| 6 | Intentar registrar DNI o colegiatura duplicada | RF08 | Rechaza con mensaje específico en español | OK |
| 7 | Registrar profesional válido vinculando cuenta `personal_medico` libre | RF08, RN01 | Guarda registro, vincula cuenta y redirige con aviso verde | OK |
| 8 | Verificar disponibilidad de cuentas en formulario | RN01 | Solo lista usuarios con rol `personal_medico` sin ficha asignada | OK |
| 9 | Visualizar ficha de profesional (`show`) | RF08 | Muestra datos personales, cuenta vinculada y próximas citas | OK |
| 10 | Editar profesional conservando su propio DNI, colegiatura y cuenta | RF08 | Actualiza sin falsos errores de duplicado (`Rule::ignore`) | OK |
| 11 | Editar profesional intentando usar colegiatura de otro médico | RF08 | Rechaza con `"Esta colegiatura ya está registrada."` | OK |
| 12 | Desactivar profesional con citas futuras pendientes/confirmadas | RF09, RN04 | Cambia `activo` a `false` y advierte cantidad de citas por reprogramar | OK |
| 13 | Reactivar profesional inactivo | RF09 | Cambia `activo` a `true` y muestra `"Profesional activado."` | OK |