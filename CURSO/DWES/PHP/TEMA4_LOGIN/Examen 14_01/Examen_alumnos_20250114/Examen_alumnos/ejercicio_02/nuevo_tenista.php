<?php
    require_once("../utiles/config.php");
    require_once("../utiles/funciones.php");

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

    try {
        $conexion = PDO($host, $user, $passwordDB, $bbdd);

		$sql = "SELECT nombre FROM torneos;";

		$consulta = $conexion->prepare($sql);

		$consulta->execute();

		$torneos = $consulta->fetchAll(PDO::FETCH_ASSOC);

		//-------------------------------------------------------------

		$anioActual = 2024;

		$aniosTitulos = [];

		for ($i=0; $i < $anioActual; $i++) { 
			if ($anioActual != 1968) {
				$aniosTitulos[] = $anioActual;
				$anioActual--;
			} else {
				$aniosTitulos[] = $anioActual;

				break;
			}
		}

		//print_r($aniosTitulos);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$altura = $_POST["altura"];
		$anno_nacimiento = $_POST["anno_nacimiento"];
		$mano = "";
		if (isset($_POST["mano"])) {
			$mano = $_POST["mano"];
		}
		$torneo = $_POST["torneo"];
		$anno_torneo = $_POST["anno"];

		if ($nombre != "" && $apellidos != "" && $altura != "" && $anno_nacimiento != "" && isset($mano)) {
			if ($torneo == "" && $anno_torneo == "") {
				try {
					$conexion = PDO($host, $user, $passwordDB, $bbdd);

					$sql = "INSERT INTO tenistas (nombre, apellidos, altura, mano, anno_nacimiento) VALUES ('$nombre', '$apellidos', $altura, '$mano', $anno_nacimiento);";

					$consulta = $conexion->prepare($sql);

					$consulta->execute();

					echo "Se han insertado los datos del tenista sin título correctamente";
				} catch (PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
			} else if ($torneo != "" && $anno_torneo != "") {
				try {
					$conexion = PDO($host, $user, $passwordDB, $bbdd);

					$sql = "INSERT INTO tenistas (nombre, apellidos, altura, mano, anno_nacimiento) VALUES ('$nombre', '$apellidos', $altura, '$mano', $anno_nacimiento);";

					$consulta = $conexion->prepare($sql);

					$consulta->execute();

					//-------------------------------------------------

					$sql = "SELECT id FROM torneos WHERE nombre LIKE '$torneo';";

					$consulta = $conexion->prepare($sql);

					$consulta->execute();

					$id_torneo = $consulta->fetchColumn();

					$sql = "SELECT id FROM tenistas WHERE nombre LIKE '$nombre';";

					$consulta = $conexion->prepare($sql);

					$consulta->execute();

					$id_tenista = $consulta->fetchColumn();

					$sql = "INSERT INTO titulos (anno, tenista_id, torneo_id) VALUES ($anno_torneo, $id_tenista, $id_torneo);";

					$consulta = $conexion->prepare($sql);

					$consulta->execute();

					echo "Se han insertado los datos del tenista y de la selección de título correctamente";
				} catch (PDOException $e) {
					echo "Error a la hora de dar de alta un nuevo tenista: " . $e->getMessage();
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta nuevo tenista</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
    <h1>Alta de un nuevo tenista</h1>

	<!--  
        ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO 
        Recuerda:
        - Crea las variables que vas a utilizar para recibir los datos del formulario y validar los datos recibidos.
		- Comprobar si hemos accedido por POST ($_SERVER["REQUEST_METHOD"] == "POST").
		- Usa la función "obtenerValorCampo" con los datos recibidos.
		- Validar: Nombre, apellidos, altura...y crea los mensajes en caso de que no cumplan los requisitos.
		- Mostrar el formulario y errores si hay.

    -->
		<!-- Formulario -->
  		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  			<p>
  				<!-- Campo nombre del tenista -->
        		<label for="nombre">Nombre:</label>
        		<input type="text" id="nombre" name="nombre" value="" minlength="3" maxlength="50">
		        <span style="color: red">
		          	<?php if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["nombre"] == ""):?>
						Debes insertar un nombre
					<?php endif;?>
		        </span>
      		</p>
      		<p>
  				<!-- Campo apellidos del tenista -->
        		<label for="apellidos">Apellidos:</label>
        		<input type="text" id="apellidos" name="apellidos" value="" minlength="5" maxlength="100">
		        <span style="color: red">
					<?php if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["apellidos"] == ""):?>
							Debes insertar apellidos
					<?php endif;?>
		        </span>
      		</p>
	    	<p>
  				<!-- Campo altura del tenista -->
        		<label for="altura">Altura:</label>
        		<input type="number" id="altura" name="altura" value="" min="120" max="250"> cm
		        <span style="color: red">
					<?php if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["altura"] == ""):?>
							Debes insertar una altura
					<?php endif;?>
		        </span>
      		</p>
      		<p>
  				<!-- Campo año de nacimiento del tenista -->
        		<label for="anno_nacimiento">Año del nacimiento:</label>
        		<input type="text" id="anno_nacimiento" name="anno_nacimiento" value="">
		        <span style="color: red">
					<?php if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["anno_nacimiento"] == ""):?>
							Debes insertar un año de nacimiento
					<?php endif;?>
		        </span>
      		</p>
      		<p>
      			<!-- Campo mano del tenista -->
				Seleccione mano:
				<input type="radio" id="mano1" name="mano" value="Diestro"/>
				<label for="mano1">Diestro</label> 
				<input type="radio" id="mano2" name="mano" value="Zurdo"/>
				<label for="mano2">Zurdo</label>
				<span style="color: red">
					<?php if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["mano"])):?>
							Debes elegir la mano dominante
					<?php endif;?>
		        </span>
			</p>
					
	        <fieldset>
	        	<legend>Título</legend>
	        	<p>
					<select id="torneo" name="torneo">
						<option value="">Seleccione Torneo</option>
						<?php foreach ($torneos as $torneo) :?>
								<option value="<?=$torneo["nombre"]?>"><?=$torneo["nombre"]?></option>
						<?php endforeach;?>
	  					
					</select>
					<span style="color: red">
						<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && (($torneo != "" && $anno_torneo == "") || ($torneo == "" && $anno_torneo != ""))) :?>
							Uno de los campos del "TÍTULO" no ha sido elegido. Por favor, asegúrese de que los datos son correctos
						<?php endif;?>
		          	</span>
				</p>
	        	<p>
					<select id="anno" name="anno">
						<option value="">Seleccione Año</option>
						<?php foreach ($aniosTitulos as $anio) :?>
							<option value="<?=$anio?>"><?=$anio?></option>
						<?php endforeach;?>
  					</select>
		          	<span style="color: red">
					  	<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && (($torneo != "" && $anno_torneo == "") || ($torneo == "" && $anno_torneo != ""))) :?>
							Uno de los campos del "TÍTULO" no ha sido elegido. Por favor, asegúrese de que los datos son correctos
						<?php endif;?>
		          	</span>
				</p>
	        </fieldset>
	        
	        <p>
	            <!-- Botón submit -->
	            <input type="submit" name="guardar" value="Guardar">
	            <!-- Botón borrar -->
	            <input type="reset" value="Borrar">
	        </p>
	    </form>
  	
						<!--  
        				ESCRIBA AQUI EL CÓDIGO HTML Y/O PHP NECESARIO. Recuerda:
						- Conéctate a la BBDD.
						- Prepara la consulta para insertar al nuevo jugador. 
						- Ejecuta la consulta de inserción.
						- A continuación, si ha ganado algún título, hay que insertarlo en la tabla "titulos"
        				-->
	    
</body>
</html>