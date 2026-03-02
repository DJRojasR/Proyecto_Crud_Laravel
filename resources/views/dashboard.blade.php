<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }
        .navbar {
            background: #e74c3c;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 { color: white; margin: 0; }
        .navbar button {
            background: white;
            color: #e74c3c;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .contenido {
            padding: 30px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Mi primer crud</h1>
        <div>
            <span style="color:white">
                Bienvenido, {{ Auth::user()->name }} ✅
            </span>
            <form method="POST" action="/logout" style="display:inline">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
    <div class="contenido">
        <h2>Dashboard</h2>
        <p>Estás dentro del sistema ✅</p>
    </div>

</body>
</html>