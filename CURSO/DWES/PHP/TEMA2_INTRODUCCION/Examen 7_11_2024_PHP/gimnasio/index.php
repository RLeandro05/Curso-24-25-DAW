<?php 
session_start(); //Iniciar sesión

//Usuarios permitidos
//usuario: admin || contraseña: admin
//usuario: usuario || contraseña: usuario

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sesionCerrada"])) {
    session_destroy(); //Cerrar sesión en caso de que se elija cerrarla
    echo "SESIÓN CERRADA";
}


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