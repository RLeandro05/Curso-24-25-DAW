<?php 
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO
{
    try {
        $mysql = "mysql:host=$host;dbname=$bbdd;charset=utf8";
        $conexion = new PDO($mysql, $user, $password);
        // Establecer el modo de error de PDO a excepciones
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

// Consulta para obtener todos los nombres de los campeones
$sql = "SELECT nombre FROM campeon";

// Preparar y ejecutar la consulta
$consulta = $conexion->prepare($sql);
$consulta->execute();

// Obtener todos los resultados
$campeones = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Mostrar los nombres de los campeones
echo "<ul>";
foreach ($campeones as $campeon) {
    echo "<li>" . htmlspecialchars($campeon['nombre']) . "</li>";
}
echo "</ul>";
?>
