<?php
//Función para conectarse a la base de datos
function conectarPDO(string $host, string $user, string $password, string $bbdd = null): PDO
{
    try {
        $mysql = $bbdd ? "mysql:host=$host;dbname=$bbdd;charset=utf8" : "mysql:host=$host;charset=utf8";
        $conexion = new PDO($mysql, $user, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }

    return $conexion;
}

//Variables de conexión
$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "dwes_manana_empresa";

try {

    //Asegurarse de que se pinchó en guardar para poder añadir al nuevo empleado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
        //Variables sacadas del formulario
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $email = $_POST["email"];
        $salario = $_POST["salario"];
        $hijos = $_POST["hijos"];
        $nacionalidad = $_POST["nacionalidad"];
        $departamento = $_POST["departamento"];

        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        //Sacar el id de la nacionalidad seleciconada
        $sql = "SELECT id FROM paises WHERE nacionalidad LIKE '$nacionalidad';";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $id_nacionalidad = $consulta->fetchColumn();

        //----------------------------------------------------------

        //Sacar el id del departamento seleccionado
        $sql = "SELECT id FROM departamentos WHERE nombre LIKE '$departamento';";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $id_departamento = $consulta->fetchColumn();


        //Una vez sacados ambos ids, insertar al nuevo empleado en la tabla con los datos
        $sql = "INSERT INTO empleados (nombre, email, apellidos, salario, hijos, departamento_id, pais_id) 
        VALUES ('$nombre', '$email', '$apellidos', $salario, $hijos, $id_departamento, $id_nacionalidad);";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        //Redirigir de nuevo al listado básico de empleados
        header("Location: listado.php");
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

    $sql = "SELECT nacionalidad FROM paises;";

    $consulta = $conexion->prepare($sql);

    $consulta->execute();

    $nacionalidades = $consulta->fetchAll(PDO::FETCH_ASSOC);

    //-------------------------------------------------

    $sql = "SELECT nombre FROM departamentos;";

    $consulta = $conexion->prepare($sql);

    $consulta->execute();

    $departamentos = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Empleado</title>
</head>
<body>
    <h1>A&ntilde;adir un nuevo empleado</h1>

    <form action="nuevo.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" minlength="3" maxlength="50">

        <br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" minlength="3" maxlength="150">

        <br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" id="email" maxlength="120">

        <br>

        <label for="salario">Salario:</label>
        <input type="number" name="salario" id="salario" min="0" step="0.01" pattern="^\d*(\.\d{0,2})?$">

        <br>

        <label for="hijos">Hijos:</label>
        <input type="number" name="hijos" id="hijos" min="0" max="10">

        <br>

        Nacionalidad:
        <select name="nacionalidad" id="nacionalidad">
            <option value="0">Seleccionar Nacionalidad</option>
            <?php foreach ($nacionalidades as $nacionalidad) :?>
                <option value="<?= $nacionalidad["nacionalidad"]?>"><?= $nacionalidad["nacionalidad"]?></option>
            <?php endforeach;?>
        </select>

        <br>

        Departamento:
        <select name="departamento" id="departamento">
            <option value="0">Seleccionar Departamento</option>
            <?php foreach ($departamentos as $departamento) :?>
                <option value="<?= $departamento["nombre"]?>"><?= $departamento["nombre"]?></option>
            <?php endforeach;?>
        </select>

        <br>

        <input type="submit" name="guardar" value="Guardar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>