<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Paciente</title>
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
        .btn-success { background: #2ecc71; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .error { color: red; font-size: 13px; }
    </style>
</head>
<body>
<div class="contenido">
    <div class="card">
        <h2>➕ Nuevo Paciente</h2>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="error">❌ {{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="/pacientes">
            @csrf

            <label>DNI:</label>
            <input type="text" name="dni" value="{{ old('dni') }}" 
                   placeholder="8 dígitos" maxlength="8" required>

            <label>Nombres:</label>
            <input type="text" name="nombres" value="{{ old('nombres') }}" 
                   placeholder="Nombres completos" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="{{ old('apellidos') }}" 
                   placeholder="Apellidos completos" required>

            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" 
                   value="{{ old('fecha_nacimiento') }}" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" 
                   placeholder="Opcional">

            <label>Estado:</label>
            <select name="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>

            <br><br>
            <button type="submit" class="btn btn-success">Guardar Paciente</button>
            <a href="/pacientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
</body>
</html>