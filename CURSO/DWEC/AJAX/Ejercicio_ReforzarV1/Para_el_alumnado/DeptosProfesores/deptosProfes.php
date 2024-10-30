<?php

header('Content-Type: application/json');
$conn = Conectar2("departamentos_profesores", "root", "");

$datos = file_get_contents('php://input');
$objeto=json_decode($datos);
/*
   $objeto = new stdClass();
   $objeto->servicio = "selProfeID";
   $objeto->id = 8;
*/
if($objeto != null) {
  switch($objeto->servicio) {
		
    case "departamentos":
    	print json_encode(listadoDepartamentos());
      break;
			
    case "profesores":
			print json_encode(listadoProfesores($objeto->id_departamento));
      break;
			
		
		case "anadeProfe":
			anadeProfe($objeto);
			print json_encode(listadoProfesores($objeto->id_departamento));
      break;
			
		
		case "eliminaProfe":
			eliminaProfe($objeto->id);
			print json_encode(listadoProfesores($objeto->id_departamento));
      break;
			
		case "modificaProfe":
			modificaProfe($objeto);
			print json_encode(listadoProfesores($objeto->id_departamento));
      break;	
		
			
		case "selProfeID":
			print json_encode(selProfeID($objeto->id));
			break;
	}
}


function listadoDepartamentos() {
	global $conn;
	try {
		$sc = "Select * From departamentos";
		$stm = $conn->prepare($sc);
		$stm->execute();
		return ($stm->fetchAll(PDO::FETCH_ASSOC));
	} catch(Exception $e) {
		die($e->getMessage());
	}
}
	
function listadoProfesores($id){
	global $conn;
	try {
		$sc = "Select * From profesores Where ID_DEPARTAMENTO = ?";
		$stm = $conn->prepare($sc);
		$stm->execute(array($id));
		return ($stm->fetchAll(PDO::FETCH_ASSOC));
	} catch(Exception $e) {
		die($e->getMessage());
	}
}


function anadeProfe($objeto) {
	global $conn;
	try {
		$sql = "INSERT INTO profesores(ID_DEPARTAMENTO, DNI, NOMBRE, APELLIDOS) VALUES (?, ?, ?, ?)";	
		$conn->prepare($sql)->execute(
			array(
				$objeto->id_departamento,
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


function modificaProfe($objeto) {
	global $conn;
	try {
		$sql = "UPDATE profesores SET 
							DNI				= ?,
							NOMBRE		= ?, 
							APELLIDOS	= ?
						WHERE ID = ?";
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



function eliminaProfe($id){
	global $conn;
	try {
		$sql = "Delete From profesores Where ID = ?";	
		$conn->prepare($sql)->execute(array($id));
		return true;
	} catch (Exception $e) {
			die($e->getMessage());
			return false;
	}
}


function selProfeID($id) {
	global $conn;
	try {
		$sc = "Select * From profesores Where ID = ?";
		$stm = $conn->prepare($sc);
		$stm->execute(array($id));
		return ($stm->fetch(PDO::FETCH_ASSOC));	
	} catch(Exception $e) {
		die($e->getMessage());
	}	
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

?>
