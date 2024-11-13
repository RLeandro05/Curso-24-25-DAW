<?php
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
        <input type="password" name="password" id="password" size="10" required> <br>

        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>