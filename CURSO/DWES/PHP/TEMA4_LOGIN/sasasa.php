<?php
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
$user = "dwes_manana";
$passwordDB = "dwes_2024";
$bbdd = "dwes_manana_tenistas";

try {
    //Guardar en una variable la conexión devuelta de la función
    $conexion = conectarPDO($host, $user, $passwordDB, $bbdd); 

    echo "Conectado";
} catch(PDOException $e) {
    echo "Error: $e";
}
?>