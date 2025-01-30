<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept, Authorization");

header('Content-Type: application/json');


$conn = Conectar2("practicaex_angular", "root", "");
 
//  Con esta línea recogemos los datos (en formato JSON), enviados por el cliente:
$datos = file_get_contents('php://input');  //  $datos es un string, y no un objeto php
//  Lo convertimos a un objeto php:
$objeto=json_decode($datos);


// $objeto = new stdClass();
// $objeto->servicio = "facturas";


if($objeto != null) {
    switch($objeto->servicio) {
			case "facturas":
        listadoFacturas();
        break;
			case "detalle":
				listadoDetalle($objeto->id);
        break;
			case "anade":
				anadeDetalle($objeto->detalle);
				listadoDetalle($objeto->detalle->id_factura);
        break;
			case "borra":
				borraDetalle($objeto->id);
				listadoDetalle($objeto->id_factura);
        break;
				
			case "modifica":
				modificaDetalle($objeto->detalle);
				listadoDetalle($objeto->detalle->id_factura);
        break;
				
		}
		
}


function listadoFacturas() {
	global $conn;
	$rs = Consulta($conn, "Select id, numero, id_cliente, fecha From facturas");
	//  Devolvemos la filas del cuerpo de la tabla:
	print json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
}

function listadoDetalle($id) {
	global $conn;
	$sc = "Select id, id_factura, cantidad, concepto, precio, tipo_iva From detalle_facturas Where ID_FACTURA = $id";
	$rs = Consulta($conn, $sc);
	//  Devolvemos la filas del cuerpo de la tabla:
	print json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
}

function anadeDetalle($objeto){
	global $conn;
	$sc = "Insert into detalle_facturas(id_factura, cantidad, concepto, precio, tipo_iva) " .
				"values($objeto->id_factura, $objeto->cantidad, '$objeto->concepto', $objeto->precio, $objeto->tipo_iva)";
	Consulta($conn, $sc);
}

function borraDetalle($id){
	global $conn;
	$sc = "Delete From detalle_facturas Where ID = $id";
	Consulta($conn, $sc);
}

function modificaDetalle($objeto){
	global $conn;
	$sc = "Update detalle_facturas Set 
			ID_FACTURA = $objeto->id_factura, 
			CANTIDAD = $objeto->cantidad, 
			CONCEPTO = '$objeto->concepto', 
			PRECIO = $objeto->precio, 
			TIPO_IVA = $objeto->tipo_iva 
			Where ID = $objeto->id";
	Consulta($conn, $sc);
}




/*  FUNCIONES PARA EL ACCESO A LOS DATOS:    */

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
