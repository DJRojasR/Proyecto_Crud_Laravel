<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Paciente</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; }
        .contenido { padding: 30px; max-width: 600px; margin: auto; }
        .card {
            background: white; padding: 30px;
            border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .campo { margin-bottom: 15px; }
        .campo label { font-weight: bold; color: #555; }
        .campo p { margin: 5px 0; font-size: 16px; }
        .btn {
            padding: 10px 20px; border: none;
            border-radius: 5px; cursor: pointer; text-decoration: none;
        }
        .btn-secondary { background: #95a5a6; color: white; }
        .badge-activo   { background: #2ecc71; color: white; padding: 3px 8px; border-radius: 10px; }
        .badge-inactivo { background: #e74c3c; color: white; padding: 3px 8px; border-radius: 10px; }
    </style>
</head>
<body>
<div class="contenido">
    <div class="card">
        <h2>👤 Detalle del Paciente</h2>

        <div class="campo">
            <label>DNI:</label>
            <p>{{ $paciente->dni }}</p>
        </div>
        <div class="campo">
            <label>Nombres:</label>
            <p>{{ $paciente->nombres }}</p>
        </div>
        <div class="campo">
            <label>Apellidos:</label>
            <p>{{ $paciente->apellidos }}</p>
        </div>
        <div class="campo">
            <label>Fecha de Nacimiento:</label>
            <p>{{ $paciente->fecha_nacimiento }}</p>
        </div>
        <div class="campo">
            <label>Teléfono:</label>
            <p>{{ $paciente->telefono ?? 'No registrado' }}</p>
        </div>
        <div class="campo">
            <label>Estado:</label>
            <p>
                @if($paciente->estado)
                    <span class="badge-activo">Activo</span>
                @else
                    <span class="badge-inactivo">Inactivo</span>
                @endif
            </p>
        </div>
        <div class="campo">
            <label>Creado por:</label>
            <p>{{ $paciente->created_us ?? '-' }}</p>
        </div>
        <div class="campo">
            <label>Actualizado por:</label>
            <p>{{ $paciente->updated_us ?? '-' }}</p>
        </div>

        <a href="/pacientes" class="btn btn-secondary">← Volver</a>
    </div>
</div>
</body>
</html>