<?php

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

header('Content-Type: application/json');  //  Todo se devolverá en formato JSON.

require_once 'modelos.php';
$modelo = new Modelo();

//  Con esta línea recogemos los datos (en formato JSON), enviados por el cliente:
$datos = file_get_contents('php://input');  //  $datos es un string, y no un objeto php
//  Lo convertimos a un objeto php:
$objeto=json_decode($datos);

//	$objeto = new stdClass();
//	$objeto->accion = "ObtenerPeliculaId";
//	$objeto->id = "2";

if($objeto != null) {
    switch($objeto->accion) {
			
			//  LISTAR Y OBTENER:
	
			case "ListarGeneros":  
				print json_encode($modelo->ListarGeneros());
				break;
			
			case "ListarInterpretes":  
				print json_encode($modelo->ListarInterpretes());
				break;
				
			case "ListarPeliculas":  
				print json_encode($modelo->ListarPeliculas());
				break;		
				
			case "ObtenerInterpreteId":  
				print json_encode($modelo->ObtenerInterpreteId($objeto->id));
				break;		
			
			case "ObtenerPeliculaId":  
				print json_encode($modelo->ObtenerPeliculaId($objeto->id));
				break;		
			
			
			//  AÑADIR (INSERTAR):
				
			case "AnadeInterprete": 
				if ($modelo->AnadeInterprete($objeto->interprete))
					print '{"result":"OK"}';
			//		print json_encode($modelo->ListarInterpretes());
				else
					print '{"result":"FAIL"}';
				break;
			
			case "AnadePelicula": 
				if ($modelo->AnadePelicula($objeto->pelicula))
					print '{"result":"OK"}';
			//		print json_encode($modelo->ListarPeliculas());
				else
					print '{"result":"FAIL"}';
				break;
			
			case "AnadeGenero": //  Hacemos que devuelva el que ha insertado
				print json_encode($modelo->AnadeGenero($objeto->genero));
				break;
			
			
			
			//  MODIFICAR (ACTUALIZAR):
			
			case "ModificaInterprete": 
				if ($modelo->ModificaInterprete($objeto->interprete))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
					
				
			case "ModificaPelicula": 
				if ($modelo->ModificaPelicula($objeto->pelicula))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;

			case "ModificaGenero": 
				if ($modelo->ModificaGenero($objeto->genero))
					print json_encode($modelo->ListarGeneros());
				else
					print '{"result":"FAIL"}';
				break;	
				
			
			//  BORRAR (ELIMINAR):
			
			case "BorrarInterprete": 
				$modelo->BorrarInterprete($objeto->id);
				if ($modelo->BorrarInterprete($objeto->id))
					print json_encode($modelo->ListarInterpretes());
				else
					print '{"result":"FAIL"}';
				break;
			
			case "BorrarPelicula": 
				if ($modelo->BorrarPelicula($objeto->id))
					print json_encode($modelo->ListarPeliculas());
				else
					print '{"result":"FAIL"}';
				break;
				
			case "BorrarGenero": 
				if ($modelo->BorrarGenero($objeto->id))
					print json_encode($modelo->ListarGeneros());
				else
					print '{"result":"FAIL"}';
				break;	
			
				
    }  //  switch($objeto->accion)
}  //  if($objeto != null)
?>
