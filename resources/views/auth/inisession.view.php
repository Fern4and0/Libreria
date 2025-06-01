<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="/Libreria/public/assets/css/login_styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Accede a tu cuenta</h1>

        <form action="/Libreria/public/index.php?uri=auth/session/userauth" method="POST" class="login-form">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" placeholder="usuario@correo.com" required>
            </div>

            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" name="contraseña" id="contraseña" placeholder="********" required>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
