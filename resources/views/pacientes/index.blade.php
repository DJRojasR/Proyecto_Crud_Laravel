<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pacientes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; }
        .navbar {
            background: #e74c3c; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar h1 { color: white; margin: 0; }
        .navbar button {
            background: white; color: #e74c3c;
            border: none; padding: 8px 16px;
            border-radius: 5px; cursor: pointer;
        }
        .contenido { padding: 30px; }
        .btn {
            padding: 8px 14px; border: none;
            border-radius: 5px; cursor: pointer;
            text-decoration: none; font-size: 14px;
        }
        .btn-primary { background: #3498db; color: white; }
        .btn-success { background: #2ecc71; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        .btn-danger  { background: #e74c3c; color: white; }
        table {
            width: 100%; border-collapse: collapse;
            background: white; border-radius: 10px;
            overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th { background: #e74c3c; color: white; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }
        .search-box { display: flex; gap: 10px; margin-bottom: 20px; }
        .search-box input {
            padding: 8px; border: 1px solid #ddd;
            border-radius: 5px; width: 300px;
        }
        .alert-success {
            background: #d4edda; color: #155724;
            padding: 10px; border-radius: 5px; margin-bottom: 15px;
        }
        .badge-activo   { background: #2ecc71; color: white; padding: 3px 8px; border-radius: 10px; }
        .badge-inactivo { background: #e74c3c; color: white; padding: 3px 8px; border-radius: 10px; }
    </style>
</head>
<body>

<div class="navbar">
    <h1>🏥 Sistema Hospital</h1>
    <div>
        <span style="color:white">{{ Auth::user()->name }}</span>
        <form method="POST" action="/logout" style="display:inline">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
</div>

<div class="contenido">
    <h2>Lista de Pacientes</h2>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Búsqueda --}}
    <form method="GET" action="/pacientes">
        <div class="search-box">
            <input type="text" name="search" 
                   placeholder="Buscar por DNI o nombre..."
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="/pacientes" class="btn btn-warning">Limpiar</a>

            @if(Auth::user()->hasPermission('crear_pacientes'))
                <a href="/pacientes/create" class="btn btn-success">+ Nuevo Paciente</a>
            @endif
        </div>
    </form>

    {{-- Tabla --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>DNI</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha Nac.</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->dni }}</td>
                <td>{{ $paciente->nombres }}</td>
                <td>{{ $paciente->apellidos }}</td>
                <td>{{ $paciente->fecha_nacimiento }}</td>
                <td>{{ $paciente->telefono ?? '-' }}</td>
                <td>
                    @if($paciente->estado)
                        <span class="badge-activo">Activo</span>
                    @else
                        <span class="badge-inactivo">Inactivo</span>
                    @endif
                </td>
                <td>
                    @if(Auth::user()->hasPermission('ver_pacientes'))
                        <a href="/pacientes/{{ $paciente->id }}" class="btn btn-primary">Ver</a>
                    @endif
                    @if(Auth::user()->hasPermission('editar_pacientes'))
                        <a href="/pacientes/{{ $paciente->id }}/edit" class="btn btn-warning">Editar</a>
                    @endif
                    @if(Auth::user()->hasPermission('eliminar_pacientes'))
                        <form method="POST" action="/pacientes/{{ $paciente->id }}" style="display:inline" id="form-{{ $paciente->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger"
                                onclick="confirmarEliminar({{ $paciente->id }}, '{{ $paciente->nombres }}')">
                                Eliminar
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center">No hay pacientes registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div style="margin-top: 20px">
        {{ $pacientes->links() }}
    </div>
</div>

{{-- SweetAlert --}}
<script>
function confirmarEliminar(id, nombre) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas eliminar al paciente ${nombre}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#3498db',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-' + id).submit();
        }
    });
}
</script>

</body>
</html>