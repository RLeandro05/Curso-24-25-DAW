<?php

header('Content-Type: application/json');

$datos = file_get_contents('php://input');
$objeto=json_decode($datos);

//  Definimos el array "asociativo" (una tarjeta de coordenadas):
$tarjeta_coordenadas = array(
		array("A" => 53, "B" => 65, "C" => 81, "D" => 11, "E" => 78, "F" => 96),
		array("A" => 23, "B" => 62, "C" => 71, "D" => 13, "E" => 78, "F" => 96),
		array("A" => 21, "B" => 29, "C" => 05, "D" => 19, "E" => 78, "F" => 96),
		array("A" => 30, "B" => 92, "C" => 57, "D" => 17, "E" => 78, "F" => 96),
		array("A" => 69, "B" => 82, "C" => 10, "D" => 15, "E" => 78, "F" => 96),
		array("A" => 69, "B" => 69, "C" => 69, "D" => 69, "E" => 75, "F" => 96),
		array("A" => 69, "B" => 69, "C" => 69, "D" => 69, "E" => 78, "F" => 96),
		array("A" => 69, "B" => 69, "C" => 69, "D" => 69, "E" => 78, "F" => 96),
		array("A" => 69, "B" => 69, "C" => 69, "D" => 69, "E" => 78, "F" => 96),
		array("A" => 69, "B" => 69, "C" => 69, "D" => 69, "E" => 78, "F" => 96)
);
	
$retraso = rand(0, 1);
sleep($retraso);	
	
	/* Posibilidades del atributo servicio:
	 * "rangoFilas" => Rango filas.
	 * "rangoColumnas" => Rango columnas.
	 * "elemento" => Elemento del array, de la tarjeta de coordenadas.
	 */

	
if($objeto != null) {
  switch($objeto->servicio) {	 
		case 'rangoFilas':  
			rangoFilas();
			break;
		case 'rangoColumnas':  
			rangoColumnas();
			break;						
		case 'elemento':  
			elementoArray($objeto->fila, $objeto->columna);
			break;
	}
}
	
	//  Devuelve un string donde cada carácter es un número, indicando las FILAS del array:
	function rangoFilas() {
		global $tarjeta_coordenadas;
		while (current($tarjeta_coordenadas)) {
	   	print key($tarjeta_coordenadas);
	    next($tarjeta_coordenadas);	 
	 	}
	}
	
	//  Devuelve un string donde cada carácter es una letra MAYÚSCULA, indicando las COLUMNAS del array:
	function rangoColumnas() {
		global $tarjeta_coordenadas;
		while (current($tarjeta_coordenadas[0])) {
	   	print key($tarjeta_coordenadas[0]);
	    next($tarjeta_coordenadas[0]);	 
	 	}
	}
	
	//  Devuelve el elemento del array indicado por los parámetros fila y columna:
	function elementoArray($fila, $columna) {
		global $tarjeta_coordenadas;
		print $tarjeta_coordenadas[$fila][$columna];
	}
	
	
	
	
	
?>