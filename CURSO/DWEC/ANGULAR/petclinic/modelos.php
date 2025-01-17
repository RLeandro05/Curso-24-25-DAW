<?php

class Modelo {

	private $pdo;

	public function __CONSTRUCT() {
		try {
			$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
			$this->pdo = new PDO('mysql:host=localhost;dbname=petclinic', 'root', '', $opciones);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
		} catch(Exception $e) {
				die($e->getMessage());
		}
	}
	
	
	//  LISTAR Y OBTENER:
	
	
	public function ListarOwners() {
		try {
		//  Simulamos el camelCase en el nombre de los campos:
			//  Hacemos un LEFT JOIN para que salgan listados aquellos que (aún) no tienen pets
			$sc = "Select o.id, first_name firstName, last_name lastName, address, city, 
					telephone, GROUP_CONCAT(p.name SEPARATOR ', ') pets  
					From owners o LEFT JOIN pets p ON(o.id = p.owner_id)
							GROUP by o.id, first_name, last_name, address, city, telephone";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			return ($stm->fetchAll(PDO::FETCH_ASSOC));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
 
	
	public function ObtenerOwnerId($id) {
		try {
			$sc = "Select o.id, first_name as firstName, last_name as lastName, address, city, 
					telephone, GROUP_CONCAT(p.name SEPARATOR ', ') pets 
					From owners o LEFT JOIN pets p ON(o.id = p.owner_id) Where o.id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			return ($stm->fetch(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerPetId($id) {	
		try {
			$sc = "Select id, name, birth_date birthDate, type_id, owner_id 
				From pets Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			$res = ($stm->fetch(PDO::FETCH_OBJ));
			$res->owner = $this->ObtenerOwnerId($res->owner_id);
			$res->type = $this->ObtenerTypeId($res->type_id);
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerVisitId($id) {	
		try {
			$sc = "Select id,  visit_date visitDate, pet_id, description  
				From visits Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			$res = ($stm->fetch(PDO::FETCH_OBJ));
			$res->pet = $this->ObtenerPetId($res->pet_id);
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerVetId($id) {	
		try {
			$sc = "Select id,  first_name firstName, last_name lastName   
				From vets Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			$res = ($stm->fetch(PDO::FETCH_OBJ));
			$res->specialties = $this->ListarEspecialidadesVetId($id);
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function ObtenerPetIdOwner($id) {	
		try {
			$sc = "Select id, name, birth_date birthDate, type_id, owner_id 
				From pets Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));	
			$res = ($stm->fetch(PDO::FETCH_OBJ));
			$res->owner = $this->ObtenerOwnerId($res->owner_id);
			$res->type = $this->ObtenerTypeId($res->type_id);
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerTypeId($id) {	
		try {
			$sc = "Select * From types Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			return ($stm->fetch(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarPetsOwnerId($id) {
		try {
			$sc = "Select p.id, p.name, birth_date birthDate, type_id typeId, t.name typeName, owner_id ownerId 
							From pets p INNER JOIN types t ON(p.type_id = t.id)  Where owner_id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			$res = $stm->fetchAll(PDO::FETCH_OBJ);
			foreach ($res as $fila) {
				$fila->visits = $this->ListarVisitasPet($fila->id);
			}
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function ListarVets() {
		try {
		//  Simulamos el camelCase en el nombre de los campos:
			$sc = "Select id, first_name firstName, last_name lastName From vets";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			$res = $stm->fetchAll(PDO::FETCH_OBJ);
			foreach ($res as $fila) {
				$fila->specialties = $this->ListarEspecialidadesVetId($fila->id);
			}
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarEspecialidadesVetId($idVet) {
		try {
		//  Simulamos el camelCase en el nombre de los campos:
			$sc = "Select id, name From vet_specialties vs 
							INNER JOIN specialties s ON(vs.specialty_id = s.id) 
							Where vs.vet_id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($idVet));
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public function ListarPettypes() {
		try {
		//  Simulamos el camelCase en el nombre de los campos:
			$sc = "Select * From types";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarSpecialties() {
		try {
		//  Simulamos el camelCase en el nombre de los campos:
			$sc = "Select * From specialties";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarVisitasPet($id) {
		try {
			$sc = "Select id, pet_id pet, visit_date visitDate, description 
							From visits Where pet_id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			return ($stm->fetchAll(PDO::FETCH_ASSOC));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	
	
	
	
	
	//  AÑADIR (INSERTAR):
	
	
	public function AnadeOwner($data) {
		try {
			$sql = "INSERT INTO owners (first_name, last_name, address, city, telephone) 
							VALUES (?, ?, ?, ?, ?)";
			$this->pdo->prepare($sql)->execute(array(
							$data->firstName, 
							$data->lastName, 
							$data->address,
							$data->city,
							$data->telephone));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function AnadePet($data) {
		try {
			$sql = "INSERT INTO pets (name, birth_date, type_id, owner_id) 
							VALUES (?, ?, ?, ?)";
			$this->pdo->prepare($sql)->execute(array(
							$data->name, 
							$data->birthDate, 
							$data->type->id,
							$data->owner->id));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function AnadeVisit($data) {
		try {
			$sql = "INSERT INTO visits (pet_id, visit_date, description) 
							VALUES (?, ?, ?)";
			$this->pdo->prepare($sql)->execute(array(
							$data->petId, 
							$data->visitDate, 
							$data->description));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function AnadeVet($data) {
		try {
			$sql = "INSERT INTO vets (first_name, last_name) VALUES (?, ?)";
			$this->pdo->prepare($sql)->execute(array($data->firstName, $data->lastName));
			//  Recuperamos el id que le ha dado:
			$vet_id = $this->pdo->lastInsertId();
			//  Añadimos ahora las especialidades:
			$resEspe = true;
			foreach ($data->specialties as $fila) {
				$resEspe = $resEspe & $this->AnadeVetSpecialties($vet_id, $fila->id);
			}
			return $resEspe;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function AnadeVetSpecialties($vet_id, $specialty_id) {
		try {
			$sql = "INSERT INTO vet_specialties (vet_id, specialty_id) VALUES (?, ?)";
			$this->pdo->prepare($sql)->execute(array($vet_id, $specialty_id));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function AnadePettype($pettype) {
		try {
			$sql = "INSERT INTO types (name) VALUES (?)";
			$this->pdo->prepare($sql)->execute(array($pettype->name));
			//  Recuperamos el id que le ha dado:
			$pettype->id = $this->pdo->lastInsertId();
			return $pettype;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	} 
	
	public function AnadeSpecialty($specialty) {
		try {
			$sql = "INSERT INTO specialties (name) VALUES (?)";
			$this->pdo->prepare($sql)->execute(array($specialty->name));
			//  Recuperamos el id que le ha dado:
			$specialty->id = $this->pdo->lastInsertId();
			return $specialty;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	
	
	
	
	
	//  BORRAR (ELIMINAR):
	
	public function BorraOwner($id) {
		try {
			$stm = $this->pdo->prepare("DELETE FROM owners WHERE id = ?");                      
			$stm->execute(array($id));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function BorraPet($id) {
		try {
			$stm = $this->pdo->prepare("DELETE FROM pets WHERE id = ?");                      
			$stm->execute(array($id));
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			return false;
		}
	}
	
	public function BorraVisit($id) {
		try {
			$stm = $this->pdo->prepare("DELETE FROM visits WHERE id = ?");                      
			$stm->execute(array($id));
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			return false;
		}
	}
	
	public function BorraVet($id) {
		try {
			//  NO está implementado el borrar en cascada en la BD. Pero si la integridad referencial
			//    en la tabla de relación vet_specialties  así que hay que borrar antes TODAS las
			//    entradas en dicha tabla (vet_specialties) para ese vet (vet_id)
			//  Todo esto debe ser en una transacción, por si algo falla que no se fastidie la BD:
			//  Comienzo de la transacción:
			
			$this->pdo->beginTransaction();
			
			$stm = $this->pdo->prepare("DELETE FROM vet_specialties WHERE vet_id = ?");                      
			$stm->execute(array($id));
			//  Ahora borramos al veterinario:
			$stm = $this->pdo->prepare("DELETE FROM vets WHERE id = ?");                      
			$stm->execute(array($id));
			
			//  Confirmamos (consolidamos) las modificaciones:
			$this->pdo->commit();	
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			//  Deshacemos las modificaciones y devolvemos error (false):
			$this->pdo->rollBack();
			return false;
		}
	}
	
	public function BorraPettype($id) {
		try {
			$stm = $this->pdo->prepare("DELETE FROM types WHERE id = ?");                      
			$stm->execute(array($id));
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			return false;
		}
	}
	
	public function BorraSpecialty($id) {
		try {
			$stm = $this->pdo->prepare("DELETE FROM specialties WHERE id = ?");                      
			$stm->execute(array($id));
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			return false;
		}
	}
	
	
	
	
	
	
	//  MODIFICAR (ACTUALIZAR):
	
	
	public function ModificaOwner($data) {
		try {
			$sql = "UPDATE owners SET 
									first_name      = ?, 
									last_name       = ?,
									address         = ?, 
									city 						= ?,
									telephone		 		= ?
							WHERE id = ?";	
			$this->pdo->prepare($sql)->execute(array(
							$data->firstName, 
							$data->lastName, 
							$data->address,
							$data->city,
							$data->telephone,
							$data->id));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function ModificaPet($data) {
		try {
			$sql = "UPDATE pets SET 
									name      	= ?, 
									birth_date  = ?,
									type_id     = ?, 
									owner_id 		= ?
							WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array(
							$data->name, 
							$data->birthDate, 
							$data->type->id,
							$data->owner->id,
							$data->id));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function ModificaVisit($data) {
		try {
			$sql = "UPDATE visits SET 
									pet_id     	= ?, 
									visit_date  = ?,
									description	= ?
							WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array(
							$data->petId, 
							$data->visitDate, 
							$data->description,
							$data->id));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function ModificaVet($data) {
		try {
			$sql = "UPDATE vets SET first_name = ?, last_name  = ? WHERE id = ?";
			//  Todo Dentro de una transacción:
			$this->pdo->beginTransaction();
			//  Actualizamos al vet:
			$this->pdo->prepare($sql)->execute(array($data->firstName, $data->lastName, $data->id));
			//  Actualizamos ahora las especialidades:
			//  Primero las borramos todas, las de ese vet:
			$stm = $this->pdo->prepare("DELETE FROM vet_specialties WHERE vet_id = ?");                      
			$stm->execute(array($data->id));
			//  Ahora añadimos las nuevas:
			foreach ($data->specialties as $fila) {
				$sql = "INSERT INTO vet_specialties (vet_id, specialty_id) VALUES (?, ?)";
				$this->pdo->prepare($sql)->execute(array($data->id, $fila->id));
			}
			//  Confirmamos (consolidamos) las modificaciones:
			$this->pdo->commit();	
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				//  Deshacemos las modificaciones y devolvemos error (false):
				$this->pdo->rollBack();
				return false;
		}
	}
	
	public function ModificaPettype($data) {
		try {
			$sql = "UPDATE types SET name = ? WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array($data->name, $data->id));		
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function ModificaSpecialty($data) {
		try {
			$sql = "UPDATE specialties SET name = ? WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array($data->name, $data->id));		
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	
	
	
}  //  class Modelo
?>

