<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept, Authorization");

header('Content-Type: application/json');
//include("conexion.php");
$conn = conectar2("minecraft", "root", "");

$datos = file_get_contents('php://input');
$objeto = json_decode($datos);

if ($objeto != null) {
    switch ($objeto->servicio) {
        case "listar":
            print json_encode(listadoBloques());
            break;
        case "insertar":
            insertarBloque($objeto);
            print json_encode(listadoBloques());
            break;
        case "borrar":
            borrarBloque($objeto->id);
            print json_encode(listadoBloques());
            break;
        case "modificar":
            modificarBloque($objeto);
            print json_encode(listadoBloques());
            break;
        case "selBloqueID":
            print json_encode(selBloqueID($objeto->id));
            break;
    }
}

// Listar todos los bloques
function listadoBloques()
{
    global $conn;
    try {
        $sc = "SELECT id, nombre, ubicacion, herramienta_para_extraer FROM bloques_minecraft ORDER BY id";
        $stm = $conn->prepare($sc);
        $stm->execute();
        return ($stm->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

// Insertar un bloque
function insertarBloque($objeto)
{
    global $conn;
    try {
        $sql = "INSERT INTO bloques_minecraft (nombre, ubicacion, herramienta_para_extraer) VALUES (?, ?, ?)";
        $conn->prepare($sql)->execute(
            array(
                $objeto->nombre,
                $objeto->ubicacion,
                $objeto->herramienta_para_extraer
            )
        );
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
        return false;
    }
}

// Borrar un bloque por ID
function borrarBloque($id)
{
    global $conn;
    try {
        $sql = "DELETE FROM bloques_minecraft WHERE id = ?";
        $conn->prepare($sql)->execute(array($id));
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
        return false;
    }
}

// Modificar un bloque
function modificarBloque($objeto)
{
    global $conn;
    try {
        $sql = "UPDATE bloques_minecraft SET 
                    nombre = ?, 
                    ubicacion = ?, 
                    herramienta_para_extraer = ?
                WHERE id = ?";
        $conn->prepare($sql)->execute(
            array(
                $objeto->nombre,
                $objeto->ubicacion,
                $objeto->herramienta_para_extraer,
                $objeto->id
            )
        );
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
        return false;
    }
}

// Seleccionar un bloque por ID
function selBloqueID($id)
{
    global $conn;
    try {
        $sc = "SELECT nombre, ubicacion, herramienta_para_extraer FROM bloques_minecraft WHERE id = ?";
        $stm = $conn->prepare($sc);
        $stm->execute(array($id));
        return ($stm->fetch(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

// Función para conectarse a la base de datos
function conectar2($bd, $usuario, $clave)
{
    try {
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        @$bd = new PDO('mysql:host=localhost;dbname=' . $bd, $usuario, $clave, $opciones);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bd;
    } catch (PDOException $e) {
        echo ("No se ha podido conectar a la base de datos. Código de error: " . $e->getMessage());
    }
}

?>
