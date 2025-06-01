<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="/Libreria/public/assets/css/login_styles.css" />
</head>
<body>
    <div class="register-wrapper">
        <h1>Crear Cuenta</h1>

        <form method="POST" action="/Libreria/public/index.php?uri=auth/register/registeruser" class="register-form">
            <div class="form-control">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required />
            </div>

            <div class="form-control">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required />
            </div>

            <div class="form-control">
                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" placeholder="********" required />
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <p class="redirect-login">
            ¿Ya tienes cuenta? <a href="/Libreria/public/index.php?uri=auth/session/inisession">Inicia sesión aquí</a>
        </p>
    </div>
</body>
</html>
