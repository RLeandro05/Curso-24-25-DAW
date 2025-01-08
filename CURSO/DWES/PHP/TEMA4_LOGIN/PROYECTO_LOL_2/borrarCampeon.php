<?php

// Conectar a la base de datos
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO
{
    try {
        $mysql = "mysql:host=$host;dbname=$bbdd;charset=utf8";
        $conexion = new PDO($mysql, $user, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
    return $conexion;
}

$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "lol_manana";

$conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

// Verificar si se ha recibido el ID del campeón a borrar
if (isset($_GET['id'])) {
    $idCampeon = $_GET['id'];

    // Eliminar el campeón de la base de datos
    $sql = "DELETE FROM campeon WHERE id = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':id', $idCampeon, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        echo "El campeón ha sido borrado exitosamente.";
    } else {
        echo "Hubo un problema al borrar el campeón.";
    }
} else {
    echo "No se ha especificado un ID para borrar.";
}

// Redirigir al listado de campeones después de borrar
header("Location: mostrar.php");  // Cambiar a la página donde se listan los campeones
exit();
?>
