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

    //Asegurarse de que se pinchó en guardar para crear un nuevo departamento
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {

        //Añadir en variables los valores sacados del formulario
        $nombre = $_POST["nombre"];
        $presupuesto = $_POST["presupuesto"];
        $sede = $_POST["sede"];

        $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

        //Primero, sacar todos los departamentos
        $sql = "SELECT nombre FROM departamentos;";

        $consulta = $conexion->prepare($sql);

        $consulta->execute();

        $departamentos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        $copiado = false;

        //Realizaremos un método de seguridad para asegurarse de que el departamento nuevo no es uno ya existente. Si $copiado sigue en false, no es uno existente
        foreach ($departamentos as $departamento) {
            if (strtoupper(str_replace(" ", "", $departamento["nombre"])) == strtoupper(str_replace(" ", "", $nombre))) {
                echo "<h3>Ya existe dicho departamento en la base de datos. Prueba con otro</h3>";

                $copiado = true;
            }
        }

        //En caso de no existir, podemos seguir
        if (!$copiado) {
            //Sacar el id de la sede seleccionada en el formulario
            $sql = "SELECT id FROM sedes WHERE nombre LIKE '$sede';";

            $consulta = $conexion->prepare($sql);

            $consulta->execute();

            $id_sede = $consulta->fetchColumn();

            //Asegurarse de que existe el id de la sede introducida. Si existe en la base de datos, se podrá crear el departamento
            if ($id_sede) {
                $sql = "INSERT INTO departamentos (nombre, presupuesto, sede_id) VALUES ('$nombre', $presupuesto, $id_sede);";

                $consulta = $conexion->prepare($sql);

                $consulta->execute();

                //Redirigir al listado de departamentos
                header("Location: listado.php");
            }
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

    $sql = "SELECT nombre FROM sedes";

    $consulta = $conexion->prepare($sql);

    $consulta->execute();

    $sedes = $consulta->fetchAll(PDO::FETCH_ASSOC);

    /*echo "<pre>";
    print_r($sedes);
    echo "</pre>";*/
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Departamento</title>
</head>
<body>
    <h1>A&ntilde;adir un nuevo departamento</h1>

    <form action="nuevo.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" minlength="3" maxlength="100">

        <br>

        <label for="presupuesto">Presupuesto:</label>
        <input type="number" name="presupuesto" id="presupuesto" min="0">

        <br>

        Sede: 
        <select name="sede" id="sede">
            <?php foreach ($sedes as $sede) :?>
                <option value="<?= $sede["nombre"]?>"><?= $sede["nombre"]?></option>
            <?php endforeach;?>
        </select>

        <br> <br>

        <input type="submit" name="guardar" value="Guardar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>