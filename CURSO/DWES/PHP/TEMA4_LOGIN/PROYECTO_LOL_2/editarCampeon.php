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

// Verificar si se ha recibido el ID del campeón a editar
if (isset($_GET['id'])) {
    $idCampeon = $_GET['id'];

    // Obtener los datos actuales del campeón
    $sql = "SELECT * FROM campeon WHERE id = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':id', $idCampeon, PDO::PARAM_INT);
    $consulta->execute();
    $campeon = $consulta->fetch(PDO::FETCH_ASSOC);

    // Si no existe el campeón con ese ID, mostrar mensaje de error
    if (!$campeon) {
        echo "Campeón no encontrado.";
        exit();
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btGuardar'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];
    $dificultad = $_POST['dificultad'];
    $descripcion = $_POST['descripcion'];

    // Actualizar los datos del campeón
    $sql = "UPDATE campeon SET nombre = :nombre, rol = :rol, dificultad = :dificultad, descripcion = :descripcion WHERE id = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':id', $idCampeon, PDO::PARAM_INT);
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':rol', $rol);
    $consulta->bindParam(':dificultad', $dificultad);
    $consulta->bindParam(':descripcion', $descripcion);

    $consulta->execute();

    if ($consulta->execute()) {
        echo "El campeón ha sido actualizado.";
        header("Location: mostrar.php");  // Redirigir después de guardar los cambios
        exit();
    } else {
        echo "Hubo un problema al actualizar los datos.";
    }
}

?>

<form action="editarCampeon.php?id=<?php echo $idCampeon; ?>" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($campeon['nombre']); ?>" required><br>

    <label for="rol">Rol:</label>
    <input type="text" name="rol" value="<?php echo htmlspecialchars($campeon['rol']); ?>" required><br>

    <label for="dificultad">Dificultad:</label>
    <input type="text" name="dificultad" value="<?php echo htmlspecialchars($campeon['dificultad']); ?>" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required><?php echo htmlspecialchars($campeon['descripcion']); ?></textarea><br>

    <input type="submit" name="btGuardar" value="Guardar cambios">
</form>
