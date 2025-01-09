<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Recoger los valores del formulario en variables
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); //Cifrar la contraseña para dar seguridad al usuario
    $email = $_POST["email"];

    //Función para conectarse a una base de datos que devuelve un objeto PDO, es decir, una conexión
    function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO
    {
        try {
            //sql en el cual tendremos el host, el nombre de la base de datos y el charset
            $mysql = "mysql:host=$host;dbname=$bbdd;charset=utf8";
            //Crear una nueva conexión PDO insertando el sql, el usuario y la contraseña pasadas
            $conexion = new PDO($mysql, $user, $password);
            //Establecer el modo de error de PDO a excepciones
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            //En caso de error por alguna excepción, dejar de ejecutar y mostrar el error
            exit($exception->getMessage());
        }

        //Devolver la conexión
        return $conexion;
    }

    //Variables
    $host = "localhost";
    $user = "root";
    $passwordDB = "";
    $bbdd = "lol_manana";

    //Guardar en una variable la conexión devuelta de la función
    $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

    //Realizar el sql en el cual insertaremos el usuario
    $sql = "INSERT INTO usuario (nombre, usuario, pass, email) 
        VALUES (:nombre, :usuario, :pass, :email)";

    //Preparar la consulta insertando en prepare() el sql
    $consulta = $conexion->prepare($sql);

    try {
        // Preparar y ejecutar la consulta
        $consulta = $conexion->prepare($sql);
        //Ejecutar la consulta pasando como parámetros las variables ya creadas de la información del usuario
        $consulta->execute([
            ":nombre" => $nombre,
            ":usuario" => $usuario,
            ":pass" => $password,
            ":email" => $email,
        ]);

        //Mostrar mensaje exitoso de que se registró correctamente
        echo nl2br("El usuario <b>".$nombre."</b> ha sido introducido en el sistema con la contraseña <b>".$password."</b>.\n");  

        echo "<a href=\"registro.php\">Pulse aquí para volver</a>";
    } catch (PDOException $e) {
        //En caso de dar error, mostrar mensaje del mismo
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
