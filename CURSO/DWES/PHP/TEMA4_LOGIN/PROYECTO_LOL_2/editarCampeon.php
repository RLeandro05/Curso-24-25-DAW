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

//Verificar si se ha recibido el id del campeón a editar para guardarlo en una variable
if (isset($_GET['id'])) {
    $idCampeon = $_GET['id'];

    //Obtener los datos actuales del campeón
    $sql = "SELECT * FROM campeon WHERE id = :id";
    //Preparar la consulta insertando el sql previamente realizado
    $consulta = $conexion->prepare($sql);

    //Dentro de la consulta, asignar a :id el valor del id del campeón que seleccionado para editar
    $consulta->bindParam(':id', $idCampeon, PDO::PARAM_INT);
    $consulta->execute();

    //Guardar en una variable el campeón que se ha recogido de la consulta
    $campeon = $consulta->fetch(PDO::FETCH_ASSOC);

    //Si no existe el campeón con ese ID, mostrar mensaje de error
    if (!$campeon) {
        echo "Campeón no encontrado.";
        exit();
    }
}

//Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btGuardar'])) {
    //Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];
    $dificultad = $_POST['dificultad'];
    $descripcion = $_POST['descripcion'];

    //Actualizar los datos del campeón
    $sql = "UPDATE campeon SET nombre = :nombre, rol = :rol, dificultad = :dificultad, descripcion = :descripcion WHERE id = :id";
    //Preparar la consulta con el sql previamente realizado
    $consulta = $conexion->prepare($sql);

    //Para cada campo, insertar el valor de sus respectivos antes de ejecutar la consulta
    $consulta->bindParam(':id', $idCampeon, PDO::PARAM_INT);
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':rol', $rol);
    $consulta->bindParam(':dificultad', $dificultad);
    $consulta->bindParam(':descripcion', $descripcion);

    //Ejecutar la consulta
    $consulta->execute();

    //Si se ejecuta correctamente, mostrar mensaje exitoso y redirigir a la tabla
    if ($consulta->execute()) {
        echo "El campeón ha sido actualizado.";
        header("Location: mostrar.php");  //Redirigir después de guardar los cambios
        exit();
    } else {
        echo "Hubo un problema al actualizar los datos.";
    }
}

?>

<!--Formulario para editar la información de cada campo del campeón seleccionado-->
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
