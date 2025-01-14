<?php
    require_once("../utiles/config.php");
    require_once("../utiles/funciones.php");

	if (!isset($_GET["idTorneo"])) {
		header("Location: listado.php");
	}

	function PDO(string $host, string $user, string $password, string $bbdd = null): PDO
    {
        try {
            $mysql = $bbdd ? "mysql:host=$host;dbname=$bbdd;charset=utf8" : "mysql:host=$host;charset=utf8";
            $conexion = new PDO($mysql, $user, $password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }

        return $conexion;
    }

	$idTorneo = $_GET["idTorneo"];

	try {
		$conexion = PDO($host, $user, $passwordDB, $bbdd);

		$sql = "SELECT nombre, ciudad FROM torneos WHERE id = $idTorneo;";

		$consulta = $conexion->prepare($sql);

		$consulta->execute();

		$torneo = $consulta->fetchObject();

		//--------------------------------------------------------------

		$sql = "SELECT nombre, id FROM superficies;";

		$consulta = $conexion->prepare($sql);

		$consulta->execute();

		$superficies = $consulta->fetchAll(PDO::FETCH_ASSOC);

		//--------------------------------------------------------------

		/*$sql = "SELECT superficies.nombre as nombre, superficies.id as id FROM superficies JOIN torneos ON superficies.id = torneos.superficie_id WHERE torneos.id = $id_torneo;";

		$consulta = $conexion->prepare($sql);

		$consulta->execute();

		$superficieSeleccionada = $consulta->fetchColumn();

		print_r($superficieSeleccionada);*/
	} catch (PDOException $exception) {
		exit($exception->getMessage());
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
		try {
			$conexion = PDO($host, $user, $passwordDB, $bbdd);

			$torneo = $_POST["torneo"];
			$ciudad = $_POST["ciudad"];
			$idSuperficie = $_POST["superficie"];
			$idTorneo = $_GET["idTorneo"];

			$sql = "UPDATE torneos SET nombre = '$torneo', ciudad = '$ciudad', superficie_id = $idSuperficie WHERE id = $idTorneo";

			$consulta = $conexion->prepare($sql);

			$consulta->execute();

			header("Location: listado.php");
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar un torneo</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
    <h1>Modificar un torneo</h1>
    
		<!--  
			ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 
			Recuerda:
			- Comprueba que nos ha llegado el dato necesario (idTorneo) de la página "listado"
			- Conéctate a la BBDD y comprueba que el dato existe.
			- Si existe, será único, por lo que podrás obtener los datos directamente.
			- No olvides hacer las validaciones necesarias para validar los datos que modificamos del torneo

    	-->
	

		<!--  
			ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 
			Recuerda:
			- Si hay errores, los mostramos
    	-->
		<!-- Formulario -->
  		<form action="modificar.php?idTorneo=<?= htmlspecialchars($idTorneo)?>" method="post">
  			<input type="hidden" name="id" value="">
	    	<p>
	            <!-- Campo nombre del torneo -->
	            <input type="text" name="torneo" placeholder="Nombre torneo" value="<?=$torneo->nombre?>" minlength="3" maxlength="60">
	            <span style="color: red">
					<!-- ESCRIBA AQUI EL CÓDIGO PHP para mostrar el error -->
	          		
	          	</span>
	        </p>
	        <p>
	            <!-- Campo ciudad del torneo -->
	            <input type="text" name="ciudad" placeholder="Ciudad" value="<?=$torneo->ciudad?>" minlength="3" maxlength="60">
	            <span style="color: red">
					<!-- ESCRIBA AQUI EL CÓDIGO PHP para mostrar el error -->
	          		
	          	</span>
	        </p>
	        <p>
	            <!-- Campo superficie -->
	            <select id="superficie" name="superficie">
	            	<option value="">Seleccione Superficie</option>
					<?php foreach ($superficies as $superficie) :?>
						<option value="<?=$superficie["id"]?>"><?=$superficie["nombre"]?></option>

					<?php endforeach;?>

  				</select>
  				<span style="color: red">
					<!-- ESCRIBA AQUI EL CÓDIGO PHP para mostrar el error -->
	          	</span>
	        </p>
	        <p>
	            <!-- Botón submit -->
	            <input type="submit" name="guardar" value="Guadar">
	        </p>
	    </form>
  	
					<!--  
        				ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO. 
						Recuerda:
						- Conéctate a la BBDD.
						- Prepara la consulta para modificar el torneo. 
						- Ejecuta la consulta de modificación.
						- Vuelve a "listados"
        			-->
	    
</body>
</html>