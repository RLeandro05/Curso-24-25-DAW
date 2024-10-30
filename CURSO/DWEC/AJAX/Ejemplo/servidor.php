<?php
//  Indicamos que el resultado va a ser en json:
header('Content-Type: application/json');

//  Si no se recibe el parámetro servicio. NOS VAMOS!!!!
if (!isset($_GET["servicio"]))
	return;

//  Para poder obtener el resultset en forma de array asociativo
//  debemos de usar la función Conectar2:
$conn = Conectar2("ajax", "root", "");


//  Recogemos el servicio que se desea del servidor:
$servicio = $_GET["servicio"];

switch ($servicio) {
    case "provincias":
        listadoProvincias();
        break;
    case "localidades":
				listadoLocalidades();
        break;
}

function listadoProvincias() {
	global $conn;
	$rs = Consulta($conn, "Select * From provincias");
	//  Devolvemos la filas del cuerpo de la tabla:
	print json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
}

function listadoLocalidades() {
	global $conn;
	$cp = -1;
	if (isset($_GET["codigop"]))
		$cp = $_GET["codigop"];
	
	$sc = "Select * From localidades Where CODIGO_PROVINCIA = " . $cp;
	$rs = Consulta($conn, $sc);
	//  Devolvemos la filas del cuerpo de la tabla:
	print json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
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
}  //  conectar2

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




