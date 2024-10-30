<?php

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
