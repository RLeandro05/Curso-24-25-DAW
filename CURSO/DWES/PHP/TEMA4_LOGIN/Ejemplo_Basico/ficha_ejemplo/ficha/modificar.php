<?php
    require_once("../utiles/variables.php");
    require_once("../utiles/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ficha</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
<body>
    <h1>Modificar Ficha</h1>
    <?php

    	$errores = [];
    	$comprobarValidacion = false;
    	$idFicha = 0;
    	
    	if (count($_REQUEST) > 0) 
    	{

    		if (isset($_GET["idficha"])) 
    		{
            	$idFicha = $_GET["idficha"];

            	//Obtenemos los datos del departamento
            	$conexion = conectarPDO($host, $user, $password, $bbdd);

        		// consulta a ejecutar
        		$select = "SELECT nombre, apellidos, email, id_ciudad, id_genero FROM ficha WHERE id = ?";

		        // preparar la consulta
		        $consulta = $conexion->prepare($select);

		        // parámetro
		        $consulta->bindParam(1, $idFicha); 

		        // ejecutar la consulta 
		        $consulta->execute();

		        // comprobamos si hay algún registro 
				if ($consulta->rowCount() == 0)
				{
					$consulta = null;
					$conexion = null;
					header("Location: listado.php");
					exit();
				}
				else 
				{
					// Obtenemos el resultado
			        $registro = $consulta->fetch();
			        
			        $nombre = $registro['nombre'];
			        $apellidos = $registro['apellidos'];
			        $email = $registro['email'];
					$ciudad = $registro['id_ciudad'];
					$genero = $registro['id_genero'];

			        
			        $consulta = null;

			        $conexion = null;
				}

            } 
            else 
            {
		    
			    $comprobarValidacion = true;
			    $longitudMinimaNombre = 3;
				$longitudMaximaNombre = 100;
				$longitudMinimaApellidos = 3;
				$longitudMaximaApellidos = 150;
				$longitudMaximaEmail = 150;
			    
			    // Obtenemos el campo del nombre de la sede y dirección
			    $idFicha = obtenerValorCampo("id");
			    $nombre = obtenerValorCampo("nombre");
			    $apellidos = obtenerValorCampo("apellidos");
			    $email = obtenerValorCampo("email");
				$ciudad = obtenerValorCampo("ciudad");
				$genero = obtenerValorCampo("genero");
			 

				 //-----------------------------------------------------
		        // Validaciones
		        //-----------------------------------------------------
				// Compruebo que el id del departamento se corresponde con uno que tengamos 
	        	$conexion = conectarPDO($host, $user, $password, $bbdd);

	        	// consulta a ejecutar
				$select = "SELECT * FROM ficha where id = :id";

				// preparar la consulta
				$consulta = $conexion->prepare($select);

				$consulta->bindParam(':id', $idFicha); 

				// ejecutar la consulta 
				$consulta->execute();

				// comprobamos si algún registro 
				if ($consulta->rowCount() == 0)
				{
					$consulta = null;
					$conexion = null;
					header("Location: listado.php");
					exit();
				}

				$consulta = null;

        		$conexion = null;

		        // Nombre y apellidos
		        if (!validarLongitudCadena($nombre, $longitudMinimaNombre ,$longitudMaximaNombre)) 
		        {
		            $errores["nombre"] = "El nombre tiene que tener una longitud mínima de $longitudMinimaNombre y máxima de $longitudMaximaNombre caracteres.";
		            $nombre = "";
		        } 
				if (!validarLongitudCadena($apellidos, $longitudMinimaApellidos ,$longitudMaximaApellidos)) 
		        {
		            $errores["apellidos"] = "Los apellidos tienen que tener una longitud mínima de $longitudMinimaApellidos y máxima de $longitudMaximaApellidos caracteres.";
		            $apellidos = "";
		        } 
				// Correo electrónico 
		        if (!validarEmail($email))
		        {
		            $errores["email"] = "El correo electrónico no es válido.";
		            $email = "";
		        }
		        elseif (strlen($email)>$longitudMaximaEmail)
		        {
					$errores["email"] = "El correo electrónico del empleado no puede superar los $longitudMaximaEmail caracteres.";
		            $email = "";
		        }
				/*else 
				{
					// Comprobar que no exita una ficha con ese email
					$conexion = conectarPDO($host, $user, $password, $bbdd);

					// consulta a ejecutar
					$select = "SELECT * FROM ficha where email = :email AND  id != :idFicha";

					// preparar la consulta
					$consulta = $conexion->prepare($select);

					$consulta->bindParam(':email', $email); 
					$consulta->bindParam(':idFicha', $idFicha); 

					// ejecutar la consulta 
					$consulta->execute();

					// comprobamos si tenemos más de un registro
					if ($consulta->rowCount() > 0)
					{
						$errores["email"] = "Ya existe un registro con ese email.";
					}

					$consulta = null;

					$conexion = null;

				}*/

		        // Ciudad
		        if (!validarEnteroPositivo($ciudad))
		        {
		            $errores["ciudad"] = "La ciudad es obligatoria.";
		            $ciudad = "";
		        }
				// Género
		        if (!validarEnteroPositivo($genero))
		        {
		            $errores["genero"] = "El género es obligatorio.";
		            $genero = "";
		        }
		        /*else
		        {

		        	// Comprobar que no exita un departamento con ese nombre
		        	$conexion = conectarPDO($host, $user, $password, $bbdd);

		        	// consulta a ejecutar
					$select = "SELECT * FROM sedes where id = :id";

					// preparar la consulta
					$consulta = $conexion->prepare($select);

					$consulta->bindParam(':id', $sede); 

					// ejecutar la consulta 
					$consulta->execute();

					// comprobamos si algún registro 
					if ($consulta->rowCount() == 0)
					{
						$errores["sede"] = 'No ha seleccionado una sede correcta.';
					}

					$consulta = null;

	        		$conexion = null;
		        }*/
		       
			}
		    
    	} 
    	/*else
    	{

    		// redireccionamos al listado de sedes si se accede directamente
  			header("Location: listado.php");
  			exit();
    	}*/
  	?>

  	<?php
  		if (!$comprobarValidacion || count($errores) > 0):
  
  	?>
  		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	    	<input type="hidden" name="id" value="<?php echo $idFicha ?>">
	    	<p>
	            <!-- Campo nombre -->
	            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre ?>">
	            <?php
	            	if (isset($errores["nombre"])):
	            ?>
	            	<p class="error"><?php echo $errores["nombre"] ?></p>
	            <?php
	            	endif;
	            ?>
	        </p>
			<p>
	            <!-- Campo apellidos -->
	            <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidos ?>">
	            <?php
	            	if (isset($errores["apellidos"])):
	            ?>
	            	<p class="error"><?php echo $errores["apellidos"] ?></p>
	            <?php
	            	endif;
	            ?>
	        </p>
	        <p>
	            <!-- Campo email -->
	            <input type="text" name="email" placeholder="Email" value="<?php echo $email ?>">
	            <?php
	            	if (isset($errores["email"])):
	            ?>
	            	<p class="error"><?php echo $errores["email"] ?></p>
	            <?php
	            	endif;
	            ?>
	        </p>
	        <p>
	            <!-- Campo Ciudad -->
	            <select id="ciudad" name="ciudad">
	            	<option value="">Seleccione Ciudad</option>
	            <?php
	            	$conexion = conectarPDO($host, $user, $password, $bbdd);

	            	$consulta = "SELECT id, ciudad FROM ciudad";
	            	
	            	$resultado = resultadoConsulta($conexion, $consulta);

  					while ($row = $resultado->fetch(PDO::FETCH_ASSOC)):
  				?>
  					<option value="<?php echo $row["id"]; ?>"  <?php echo $row["id"] == $ciudad ? "selected" : "" ?>><?php echo $row["ciudad"]; ?></option>
  				<?php
  					endwhile;
  				
					$resultado = null;

        			$conexion = null;
  				?>
  				</select>
  				
	            <?php
	            	if (isset($errores["ciudad"])):
	            ?>
	            	<p class="error"><?php echo $errores["ciudad"] ?></p>
	            <?php
	            	endif;
	            ?>
	        </p>

			<p>
	            <!-- Campo Género -->
	            <select id="genero" name="genero">
	            	<option value="">Seleccione Género</option>
	            <?php
	            	$conexion = conectarPDO($host, $user, $password, $bbdd);

	            	$consulta = "SELECT id, genero FROM genero";
	            	
	            	$resultado = resultadoConsulta($conexion, $consulta);

  					while ($row = $resultado->fetch(PDO::FETCH_ASSOC)):
  				?>
  					<option value="<?php echo $row["id"]; ?>"  <?php echo $row["id"] == $genero ? "selected" : "" ?>><?php echo $row["genero"]; ?></option>
  				<?php
  					endwhile;
  				
					$resultado = null;

        			$conexion = null;
  				?>
  				</select>
  				
	            <?php
	            	if (isset($errores["genero"])):
	            ?>
	            	<p class="error"><?php echo $errores["genero"] ?></p>
	            <?php
	            	endif;
	            ?>
	        </p>

	        <p>
	            <!-- Botón submit -->
	            <input type="submit" value="Guadar">
	        </p>
	    </form>
  	<?php
  		else:
  			$conexion = conectarPDO($host, $user, $password, $bbdd);

			// consulta a ejecutar
			$insert = "update ficha set nombre = :nombre, apellidos = :apellidos, email = :email, id_ciudad = :ciudad, id_genero = :genero  WHERE id = :idFicha";

			// preparar la consulta
			$consulta = $conexion->prepare($insert);

			$consulta->bindParam(':nombre', $nombre); 
			$consulta->bindParam(':apellidos', $apellidos);
			$consulta->bindParam(':email', $email);
			$consulta->bindParam(':ciudad', $ciudad); 
			$consulta->bindParam(':genero', $genero); 
			$consulta->bindParam(':idFicha', $idFicha);
		
			// ejecutar la consulta y mostramos el error
			try 
			{
				$consulta->execute();
			}
			catch (PDOException $exception)
			{
           		exit($exception->getMessage());
        	}

			$consulta = null;

			$conexion = null;

        	// redireccionamos al listado de departamentos
  			header("Location: listado.php");
  			
    	endif;
    ?>
    <div class="contenedor">
        <div class="enlaces">
            <a href="listado.php">Volver al listado de departamentos</a>
        </div>
   	</div>
    
</body>
</html>