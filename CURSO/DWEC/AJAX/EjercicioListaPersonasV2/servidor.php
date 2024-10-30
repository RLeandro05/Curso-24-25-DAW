<?php
header('Content-Type: application/json');
//include("conexion.php");
$conn = Conectar2("ajax", "root", "");

$datos = file_get_contents('php://input');
$objeto=json_decode($datos);

//$objeto = new stdClass();
//$objeto->servicio = "listar";

if($objeto != null) {
  switch($objeto->servicio) {
    case "listar":
    	print json_encode(listadoPersonas());
      break;
    case "insertar":
      insertarPersona($objeto);
			print json_encode(listadoPersonas());
      break;
    case "borrar":
      borrarPersona($objeto->id);
			print json_encode(listadoPersonas());
      break;
		case "modificar":
			modificarPersona($objeto);
			print json_encode(listadoPersonas());
			break;
			
		case "selPersonaID":
			print json_encode(selPersonaID($objeto->id));
	}
}

function listadoPersonas() {
	global $conn;
	try {
		$sc = "Select * From personas Order By ID";
		$stm = $conn->prepare($sc);
		$stm->execute();
		return ($stm->fetchAll(PDO::FETCH_ASSOC));
	} catch(Exception $e) {
		die($e->getMessage());
	}
}

function insertarPersona($objeto) {
	global $conn;
	try {
		$sql = "INSERT INTO personas(DNI, NOMBRE, APELLIDOS) VALUES (?, ?, ?)";	
		$conn->prepare($sql)->execute(
			array(
				$objeto->dni,
				$objeto->nombre,
				$objeto->apellidos
				)
			);
		return true;
	} catch (Exception $e) {
			die($e->getMessage());
			return false;
	}
}

function borrarPersona($id){
	global $conn;
	try {
		$sql = "Delete From personas Where ID = ?";	
		$conn->prepare($sql)->execute(array($id));
		return true;
	} catch (Exception $e) {
			die($e->getMessage());
			return false;
	}
}

function modificarPersona($objeto) {
	global $conn;
	try {
		$sql = "UPDATE personas SET 
							DNI				= ?,
							NOMBRE		= ?, 
							APELLIDOS	= ?
						WHERE id = ?";
		$conn->prepare($sql)->execute(
		array(
			$objeto->dni,
			$objeto->nombre, 
			$objeto->apellidos, 
			$objeto->id
			) 
		);
		return true;
	} catch (Exception $e) {
		die($e->getMessage());
		return false;
	}
}

function selPersonaID($id) {
	global $conn;
	try {
		$sc = "Select * From personas Where ID = ?";
		$stm = $conn->prepare($sc);
		$stm->execute(array($id));
		return ($stm->fetch(PDO::FETCH_ASSOC));
	} catch(Exception $e) {
		die($e->getMessage());
	}	
}

function Conectar($bd, $usuario, $clave) {
	$conn = null;
	try {
		//  NOS CONECTAMOS (y seleccionamos la bd):
    $conn = new PDO('mysql:host=localhost;dbname='. $bd, $usuario, $clave);
	} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
	}
	return $conn;
}


function conectar2($bd, $usuario, $clave) {
  try {
      $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
      @$bd = new PDO('mysql:host=localhost;dbname='. $bd, $usuario, $clave, $opciones);
      $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //aquí le digo que voy a utilizar excepciones
      return $bd;
  } catch (PDOException $e) {
      echo("No se ha podido conectar a la base de datos. Código de error: " . $e->getMessage());
  }
}


/*funciones de conexión*/
function Consulta($conn, $sc) {
	$rs = null;
	try {
		$rs = $conn->query($sc);
	} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
	}
	return $rs;
}


?>




