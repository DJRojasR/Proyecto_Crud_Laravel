<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
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
    </style>
</head>
<body>
    <div class="login-box">

        <h2>Iniciar Sesión</h2>
        {{-- Mostrar errores --}}
        @if($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif
        <form method="POST" action="/login">
            @csrf
            <label>Email:</label>
                <input type="email" name="email"  value="{{ old('email') }}"  placeholder="correo@ejemplo.com" required>
            <label>Contraseña:</label>
                <input type="password" name="password" placeholder="tu contraseña" required>
                <br><br>
                <button type="submit">Entrar</button>
        <div class="link" style="text-align:center; margin-top:15px">
            <p>¿No tienes cuenta? <a href="/register">Regístrate</a></p>
        </div>
        </form>
    </div>
</body>
</html>