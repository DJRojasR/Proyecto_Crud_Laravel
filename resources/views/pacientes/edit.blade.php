<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; }
        .contenido { padding: 30px; max-width: 600px; margin: auto; }
        .card {
            background: white; padding: 30px;
            border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, select {
            width: 100%; padding: 10px; margin: 8px 0;
            border: 1px solid #ddd; border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            padding: 10px 20px; border: none;
            border-radius: 5px; cursor: pointer; text-decoration: none;
        }
        .btn-warning { background: #f39c12; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .error { color: red; font-size: 13px; }
    </style>
</head>
<body>
<div class="contenido">
    <div class="card">
        <h2>✏️ Editar Paciente</h2>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="error">❌ {{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="/pacientes/{{ $paciente->id }}">
            @csrf
            @method('PUT')

            <label>DNI:</label>
            <input type="text" name="dni" value="{{ old('dni', $paciente->dni) }}" 
                   maxlength="8" required>

            <label>Nombres:</label>
            <input type="text" name="nombres" value="{{ old('nombres', $paciente->nombres) }}" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}" required>

            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" 
                   value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="{{ old('telefono', $paciente->telefono) }}">

            <label>Estado:</label>
            <select name="estado">
                <option value="1" {{ $paciente->estado == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $paciente->estado == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>

            <br><br>
            <button type="submit" class="btn btn-warning">Actualizar Paciente</button>
            <a href="/pacientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
</body>
</html>