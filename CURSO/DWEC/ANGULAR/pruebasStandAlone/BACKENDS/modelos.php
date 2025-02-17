<?php

class Modelo {

	private $pdo;

	public function __CONSTRUCT() {
		try {
			$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
			$this->pdo = new PDO('mysql:host=localhost;dbname=cine', 'root', '', $opciones);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
		} catch(Exception $e) {
				die($e->getMessage());
		}
	}
	
	
	//  LISTAR Y OBTENER:
	
	public function ListarGeneros() {
		try {
		//  Simulamos el camelCase en el nombre de los campos:
			$sc = "Select * From generos";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarInterpretes() {
		try {
			$sc = "Select * From interpretes";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarPeliculas() {
		try {
			$sc = "Select p.id, p.nombre, p.fecha, JSON_OBJECT('id', g.id, 'nombre', g.nombre) as genero,
								p.sinopsis From peliculas p 
								INNER JOIN generos g ON(g.id = p.id_genero)";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			$res = $stm->fetchAll(PDO::FETCH_OBJ);
			foreach ($res as $fila) {
				$fila->genero = json_decode($fila->genero);
			}
			return ($res);
		//	return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ListarPeliculas_SEG() {
		try {
			$sc = "Select p.*, g.nombre as genero From peliculas p 
								INNER JOIN generos g ON(g.id = p.id_genero)";
			$stm = $this->pdo->prepare($sc);
			$stm->execute();
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerInterpreteId($id) {
		try {
			$sc = "Select * From interpretes Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			$res = ($stm->fetch(PDO::FETCH_OBJ));
			if ($res) 
				$res->peliculas = $this->ObtenerPeliculasIdInterprete($res->id);
			return ($res);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerPeliculaIdGenero($id) {
		try {
			$sc = "Select * From generos Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			return ($stm->fetch(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerPeliculasIdInterprete($id) {
		try {
			$sc = "Select p.* From peliculas p 
								INNER JOIN peliculas_interpretes pi ON(p.id = pi.id_pelicula) Where pi.id_interprete = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerPeliculaId($id) {
		try {
		//	$sc = "Select id, nombre, fecha, sinopsis From peliculas Where id = ?";
			$sc = "Select * From peliculas Where id = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			$res = ($stm->fetch(PDO::FETCH_OBJ));
			if ($res) {
				$objeto = new stdClass();
				$objeto->id = $res->id;
				$objeto->nombre = $res->nombre;
				$objeto->fecha = $res->fecha;
				$objeto->sinopsis = $res->sinopsis;
				
				$objeto->genero = $this->ObtenerPeliculaIdGenero($res->id_genero);
				$objeto->interpretes = $this->ObtenerInterpretesIdPelicula($res->id);
			}
			return ($objeto);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function ObtenerInterpretesIdPelicula($id) {
		try {
			$sc = "Select i.* From interpretes i 
								INNER JOIN peliculas_interpretes pi ON(i.id = pi.id_interprete) Where pi.id_pelicula = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			return ($stm->fetchAll(PDO::FETCH_OBJ));
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
	

	
	//  AÑADIR (INSERTAR):
		
	public function AnadeInterprete($data) {
		try {
			$sql = "INSERT INTO interpretes (nombre, apellidos, fecha_nacimiento, biografia) 
							VALUES (?, ?, ?, ?)";
			$this->pdo->prepare($sql)->execute(array(
							$data->nombre, 
							$data->apellidos, 
							$data->fecha_nacimiento,
							$data->biografia));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	//  Añadirmos en la relación peliculas e interpretes:
	public function AnadePeliculaInterpretes($id_pelicula, $id_interprete) {
		try {
			$sql = "INSERT INTO peliculas_interpretes (id_pelicula, id_interprete) VALUES (?, ?)";
			$this->pdo->prepare($sql)->execute(array($id_pelicula, $id_interprete));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function AnadePelicula($data) {
		try {
			$sql = "INSERT INTO peliculas (nombre, fecha, id_genero, sinopsis) 
							VALUES (?, ?, ?, ?)";
			$this->pdo->prepare($sql)->execute(array(
							$data->nombre, 
							$data->fecha, 
							$data->genero->id,
							$data->sinopsis));
			
			//  Recuperamos el id que le ha dado:
			$peli_id = $this->pdo->lastInsertId();
			//  Añadimos ahora las películas, si se han seleccionado:
			$resEspe = true;
			foreach ($data->interpretes as $fila) {
				$resEspe = $resEspe & $this->AnadePeliculaInterpretes($peli_id, $fila->id);
			}
			return $resEspe;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}

	public function AnadeGenero($genero) {
		try {
			$sql = "INSERT INTO generos (nombre) VALUES (?)";
			$this->pdo->prepare($sql)->execute(array($genero->nombre));
			//  Recuperamos el id que le ha dado:
			$genero->id = (int)$this->pdo->lastInsertId();
			return $genero;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}

	
	//  BORRAR (ELIMINAR):
	
	public function BorrarInterprete($id) {
		try {
			$stm = $this->pdo->prepare("DELETE FROM interpretes WHERE id = ?");                      
			$stm->execute(array($id));
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			return false;
		}
	}
	
	public function BorrarPelicula($id) {
		try {
			//  NO está implementado el borrar en cascada en la BD. Pero si la integridad referencial
			
			//  Todo esto debe ser en una transacción, por si algo falla que no se fastidie la BD:
			//  Comienzo de la transacción:
			
			$this->pdo->beginTransaction();
			//  Borramos en la tabla de relaciones:
			$stm = $this->pdo->prepare("DELETE FROM peliculas_interpretes WHERE id_pelicula = ?");                      
			$stm->execute(array($id));
			//  Ahora borramos la película:
			$stm = $this->pdo->prepare("DELETE FROM peliculas WHERE id = ?");                      
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
	
	public function BorrarGenero($id) {
		try {
			//  Ver primero si ese género está en alguna película:
			//  SELECT COUNT(*) FROM
			$sc = "Select COUNT(*) as cuenta From peliculas Where id_genero = ?";
			$stm = $this->pdo->prepare($sc);
			$stm->execute(array($id));
			
			$fila = $stm->fetch(PDO::FETCH_ASSOC);
			if ($fila["cuenta"] > 0)  {
				//  Ese género está en alguna peli, NO se puede borrar:
				return false;
			}
			
			$stm = $this->pdo->prepare("DELETE FROM generos WHERE id = ?");                      
			$stm->execute(array($id));
			return true;
		} catch(Exception $e) {
			die($e->getMessage());
			return false;
		}
	}
	
	
	//  MODIFICAR (ACTUALIZAR):
	
	public function ModificaInterprete($data) {
		try {
			$sql = "UPDATE interpretes SET 
									nombre      			= ?, 
									apellidos  				= ?,
									fecha_nacimiento  = ?, 
									biografia			 		= ?
							WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array(
							$data->nombre, 
							$data->apellidos, 
							$data->fecha_nacimiento,
							$data->biografia,
							$data->id));
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	public function ModificaPelicula($data) {
		try {
			$sql = "UPDATE peliculas SET nombre = ?, fecha  = ?, id_genero = ?, sinopsis = ? WHERE id = ?";
			//  Todo Dentro de una transacción:
			$this->pdo->beginTransaction();
			//  Actualizamos al vet:
			$this->pdo->prepare($sql)->execute(array(
					$data->nombre, 
					$data->fecha,
					$data->genero->id,
					$data->sinopsis,
					
					$data->id));
					
			//  Actualizamos ahora las especialidades:
			//  Primero las borramos todas, las de ese vet:
			$stm = $this->pdo->prepare("DELETE FROM peliculas_interpretes WHERE id_pelicula = ?");                      
			$stm->execute(array($data->id));
			//  Ahora añadimos las nuevas:
			foreach ($data->interpretes as $fila) {
				$sql = "INSERT INTO peliculas_interpretes (id_pelicula, id_interprete) VALUES (?, ?)";
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
	
	public function ModificaGenero($data) {
		try {
			$sql = "UPDATE generos SET nombre = ? WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array($data->nombre, $data->id));		
			return true;
		} catch (Exception $e) {
				die($e->getMessage());
				return false;
		}
	}
	
	
}  //  class Modelo
?>

