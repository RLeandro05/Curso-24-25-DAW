<?php 
session_start();
session_unset();
session_destroy();

//evita el almacenamiento en caché
header('Cache-Control: no-store, no-cache, must-revalidate');

$aux= session_id();
print_r(nl2br( "\n El SID actual antes de iniciar el código de cierre de sesion es: " . session_id(). "\n"));


?>
<!DOCTYPE html>
<html>
<head>
    <title>Gimnasio Iron Forge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo de Iron Forge">
        <h1>Donde se forjan las leyendas</h1>
    </header>
    <nav>
    <a href="catalogo.html">Ver catálogo de ofertas</a>
    </nav>

<nav><form action="login.php" method="post">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>
    <br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>
    <br>
    <input type="submit" value="Iniciar sesión">
</form></nav>
    <main>
        <section>
            <h3>Sobre Nosotros</h3>
            <p>Nuestra misión...</p>
            <p>Nuestros valores...</p>
        </section>
        <section>
            <h3>Contacto</h3>
            <p>Teléfono: ...</p>
            <p>Dirección: Calle Falsa 123</p>
            <p>Localización: Ciudad, País</p>
        </section>
        <section>
            <h3>El Gimnasio en las redes</h3>
            <p>Síguenos en: <a href="https://www.facebook.com/">Facebook</a>, <a href="https://www.instagram.com/">Instagram</a></p>
        </section>
    </main>

    <footer>
        <p>Página web creada en 2024</p>
    </footer>
</body>
</html>