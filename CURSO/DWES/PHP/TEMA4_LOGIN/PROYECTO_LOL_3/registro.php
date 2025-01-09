<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>¡Bienvenido, usuario! Ingrese sus datos para registrarse</h1>

    <div id="formularioRegistro">
        <form action="nuevoUsuario.php" method="post">
            <p>
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" required>
            </p>
            <p>
                <label for="usuario">Usuario: </label>
                <input type="text" name="usuario" id="usuario" required>
            </p>
            <p>
                <label for="password">Contrase&ntilde;a: </label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required>
            </p>
            <p>
                <input type="submit" value="Registrarse">
                <input type="reset" value="Borrar">
            </p>
        </form>
    </div>
</body>
</html>