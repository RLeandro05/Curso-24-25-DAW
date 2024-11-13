<?php
    session_start();

    class Usuario { //Definición de la clase Usuario
        //Instanciar variables privadas
        private $nombre;
        private $email;
        private $password;

        //Crear constructor pasando como parámetros las anteriores variables
        public function __construct($nombre, $email, $password) {
            //Pasar los valores de esas variables en atributos
            $this->nombre = $nombre;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_DEFAULT); //Encriptar la contraseña con PASSWORD_DEFAULT
        }

        //Funciónn que devuelve el valor del nombre
        public function getNombre() {
            return $this->nombre;
        }

        //Función que, al ser llamada, a partir del password nuevo para cambiar, cambia la contraseña
        public function cambiarPassword($nuevoPassword) {
            $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);

            echo "Contraseña cambiada";
        }
    }

    //Asegurar de que se envió el nombre en el formulario
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"])) {
        //Guardar el valor de los elementos en variables
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        //Crear un nuevo usuario pasando al constrcutor las variables nuevas como parámetros
        $usuario = new Usuario($nombre, $email, $password);

        //Añadir el objeto usuario a una nueva sesión
        $_SESSION["usuario"] = $usuario;

        //Mostrar por pantalla a través de getNombre() el usuario registrado
        echo nl2br("<br><br>Usuario '".$usuario->getNombre()."' registrado correctamente <br><br>");

        //Mostrar un nuevo formulario tras crear el nuevo usuario, el cual de la opción de cambiar la contraseña
        echo "<form action=\"Ejercicio1.php\" method=\"post\">";
        echo nl2br("<label for=\"nuevoPass\">Cambiar Contraseña: </label>");
        echo nl2br("<input type=\"password\" name=\"nuevoPass\" id=\"nuevoPass\">    ");

        echo nl2br("<input type=\"submit\" value=\"Cambiar\">");

        echo "</form>";
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nuevoPass"])) {
        //Guardar el valor como variable
        $nuevoPassword = $_POST["nuevoPass"];

        //Si existe la sesión de usuario, pasarlo a una variable
        if(isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];

            //Llamar al método para cambiar la contraseña
            $usuario->cambiarPassword($nuevoPassword);
        } else { //Si no existe, mostrar mensaje de error
            echo "No existe ningún usuario";
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>
<body>
    <form action="Ejercicio1.php" method="post">
        <h2>Registrar Usuario</h2>
        
        <br>

        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" size="10" required> <br>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" size="20" required> <br>

        <label for="password">Contrase&ntilde;a: </label>
        <input type="password" name="password" id="password" size="10" required> <br> <br>

        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>