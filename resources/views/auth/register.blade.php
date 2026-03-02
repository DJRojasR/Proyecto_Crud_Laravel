<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 { text-align: center; color: #333; }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background: #c0392b; }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-size: 14px; }
        .link { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Crear Cuenta</h2>

        {{-- Mostrar errores --}}
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="/register">
            @csrf

            <label>Nombre:</label>
            <input type="text" name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Tu nombre" required>

            <label>Email:</label>
            <input type="email" name="email" 
                   value="{{ old('email') }}" 
                   placeholder="correo@ejemplo.com" required>

            <label>Contraseña:</label>
            <input type="password" name="password" 
                   placeholder="mínimo 6 caracteres" required>

            <label>Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" 
                   placeholder="repite tu contraseña" required>

            <br><br>
            <button type="submit">Registrarse</button>
        </form>

        <div class="link">
            <p>¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>