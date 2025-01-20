<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept, Authorization");

header('Content-Type: application/json');

/*
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');  //  Todo se devolverá en formato JSON.
*/


require_once 'modelos.php';
$modelo = new Modelo();

//  Con esta línea recogemos los datos (en formato JSON), enviados por el cliente:
$datos = file_get_contents('php://input');  //  $datos es un string, y no un objeto php
//  Lo convertimos a un objeto php:
$objeto=json_decode($datos);

	//$objeto = new stdClass();
	//$objeto->accion = "ListarOwners";
	//$objeto->id = 9;

if($objeto != null) {
    switch($objeto->accion) {
			
			
			//  LISTAR Y OBTENER:
			
			case "ListarOwners": 
				print json_encode($modelo->ListarOwners());
				break;
				
			case "ObtenerOwnerId": 
				print json_encode($modelo->ObtenerOwnerId($objeto->id));
				break;
				
			case "ListarPetsOwnerId":
				print json_encode($modelo->ListarPetsOwnerId($objeto->id));
				break;
				
			case "ObtenerOwnerId_Pets":
				$ownersPets = $modelo->ObtenerOwnerId($objeto->id);
				$ownersPets->pets = $modelo->ListarPetsOwnerId($objeto->id);
				print json_encode($ownersPets);
				break;	
			
			case "ListarVets":  
				print json_encode($modelo->ListarVets());
				break;
				
			case "ListarPettypes":  
				print json_encode($modelo->ListarPettypes());
				break;
				
			case "ListarSpecialties":  
				print json_encode($modelo->ListarSpecialties());
				break;	
				
			case "ListarVisitasPet":  
				print json_encode($modelo->ListarVisitasPet($objeto->id));
				break;	
				
			case "ObtenerPetIdOwner": 
				print json_encode($modelo->ObtenerPetIdOwner($objeto->id));
				break;
					
			case "ObtenerPetId": 
				print json_encode($modelo->ObtenerPetId($objeto->id));
				break;
				
			case "ObtenerVisitId": 
				print json_encode($modelo->ObtenerVisitId($objeto->id));
				break;
				
			case "ObtenerVetId": 
				print json_encode($modelo->ObtenerVetId($objeto->id));
				break;
				
				
				
				
				
				
				
				
			//  AÑADIR (INSERTAR):
				
			case "AnadeOwner": 
				if ($modelo->AnadeOwner($objeto->owner))
					print '{"result":"OK"}';
			//		print json_encode($modelo->ListarOwners());
				else
					print '{"result":"FAIL"}';
				break;
				
			case "AnadePet": 
				if ($modelo->AnadePet($objeto->pet))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;	
				
			case "AnadeVisit": 
				if ($modelo->AnadeVisit($objeto->visit))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;	

			case "AnadeVet": 
				if ($modelo->AnadeVet($objeto->vet))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;	
			
			case "AnadePettype": //  Hacemos que devuelva el que ha insertado
				print json_encode($modelo->AnadePettype($objeto->pettype));
				break;	
				
			case "AnadeSpecialty": //  Hacemos que devuelva el que ha insertado
				print json_encode($modelo->AnadeSpecialty($objeto->specialty));
				break;	
				
				
				
				
				
				
				
				
			//  BORRAR (ELIMINAR):
				
			case "BorraOwner": 
				$modelo->BorraOwner($objeto->id);
				if ($objeto->listado == "OK")
					print json_encode($modelo->ListarOwners());
				else
					print '{"result":"OK"}';
				break;
				
			case "BorraPet": 
				if ($modelo->BorraPet($objeto->id))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
			case "BorraVisit": 
				if ($modelo->BorraVisit($objeto->id))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
			case "BorraVet": 
				if ($modelo->BorraVet($objeto->id))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
			case "BorraPettype": 
				if ($modelo->BorraPettype($objeto->id))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
			case "BorraSpecialty": 
				if ($modelo->BorraSpecialty($objeto->id))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
				
				
				
				
				
				
			//  MODIFICAR (ACTUALIZAR):
				
			case "ModificaOwner": 
				if ($modelo->ModificaOwner($objeto->owner))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
			case "ModificaPet": 
				if ($modelo->ModificaPet($objeto->pet))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;
				
			case "ModificaVet": 
				if ($modelo->ModificaVet($objeto->vet))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;	
				
			case "ModificaVisit": 
				if ($modelo->ModificaVisit($objeto->visit))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;	
				
			case "ModificaPettype": 
				if ($modelo->ModificaPettype($objeto->pettype))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;		
				
			case "ModificaSpecialty": 
				if ($modelo->ModificaSpecialty($objeto->specialty))
					print '{"result":"OK"}';
				else
					print '{"result":"FAIL"}';
				break;	
				
    }  //  switch($objeto->accion)
}  //  if($objeto != null)
?>
