<?php

//Función para conectarse a una base de datos que devuelve un objeto PDO, es decir, una conexión
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO {
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

//Verificar si se ha recibido el id del campeón a borrar para guardarlo en una variable
if (isset($_GET['id'])) {
    $idCampeon = $_GET['id'];

    //Realizar la consulta donde se eliminará al campeón específico
    $sql = "DELETE FROM campeon WHERE id = :id";
    //Preparar la consulta en la cual se insertará el sql anteriormente realizado
    $consulta = $conexion->prepare($sql);

    //Dentro de la consulta, asignar a :id el valor del id del campeón que seleccionado para borrar
    $consulta->bindParam(':id', $idCampeon, PDO::PARAM_INT);

    //Ejecutar la consulta
    if ($consulta->execute()) {
        echo "El campeón ha sido borrado exitosamente.";
    } else {
        echo "Hubo un problema al borrar el campeón.";
    }
} else {
    echo "No se ha especificado un ID para borrar.";
}

//Redirigir al listado de campeones después de borrar
header("Location: mostrar.php");  //Cambiar a la página donde se listan los campeones
exit();
?>
