<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btBorrar"])) {
    $idCampeon = $_POST['idCampeon']; 
    // Llamar a una función o procesar el borrado aquí.
    header("Location: borrarCampeon.php?id=$idCampeon");
    exit();
}

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

// Consulta para obtener todos los nombres de los campeones
$sql = "SELECT * FROM campeon";

// Preparar y ejecutar la consulta
$consulta = $conexion->prepare($sql);
$consulta->execute();

// Obtener todos los resultados
$campeones = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo "<table border=\"1\">";
echo "<thead>";
echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Rol</th>";
    echo "<th>Dificultad</th>";
    echo "<th>Descripcion</th>";
    echo "<th>Borrar</th>";
    echo "<th>Editar</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
foreach ($campeones as $campeon) {
    echo "<tr>";
        echo "<td>" . htmlspecialchars($campeon['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($campeon['rol']) . "</td>";
        echo "<td>" . htmlspecialchars($campeon['dificultad']) . "</td>";
        echo "<td>" . htmlspecialchars($campeon['descripcion']) . "</td>";
        
        // Formulario para borrar
        echo "<form action=\"mostrar.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"idCampeon\" value=\"" . $campeon['id'] . "\">";  // Añadir el ID del campeón
            echo "<td><input type=\"submit\" name=\"btBorrar\" value=\"Borrar\"></td>";
        echo "</form>";
        
        // Botón de editar
        echo "<td><a href=\"editarCampeon.php?id=" . $campeon['id'] . "\"><button>Editar</button></a></td>";
    echo "</tr>";
}
echo "</tbody>";

echo "</table>";
?>
