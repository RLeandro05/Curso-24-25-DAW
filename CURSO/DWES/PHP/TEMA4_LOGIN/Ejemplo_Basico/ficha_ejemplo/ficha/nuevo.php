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
    <title>Alta nuevo Registro</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>
    <h1>Alta de un nuevo registro</h1>
    <?php

    	$errores = [];
    	$comprobarValidacion = false;
    	$errores = [];
    	$comprobarValidacion = false;
    	
    	$nombre = "";
    	$longitudMinimaNombre = 3;
		$longitudMaximaNombre = 50;
    	$apellidos = "";
    	$longitudMinimaApellidos = 3;
		$longitudMaximaApellidos = 150;
    	$email = "";
    	$longitudMaximaEmail = 120;
    	
    	$ciudad = "";
    	$genero = "";

    	if ($_SERVER["REQUEST_METHOD"]=="POST")
    	{
		    
		    $comprobarValidacion = true;
		    
		    // Obtenemos el campo del nombre de la sede y dirección
		    $nombre = obtenerValorCampo("nombre");
		    $apellidos = obtenerValorCampo("apellidos");
		    $email = obtenerValorCampo("email");
		    $ciudad = obtenerValorCampo("ciudad");
		    $genero = obtenerValorCampo("genero");
		   
		    
	    	//-----------------------------------------------------
	        // Validaciones
	        //-----------------------------------------------------
	        // Nombre, Apellidos & email
	        if (!validarLongitudCadena($nombre, $longitudMinimaNombre ,$longitudMaximaNombre)) 
	        {
	            $errores["nombre"] = "El nombre tiene que tener una longitud mínima de $longitudMinimaNombre y máxima de $longitudMaximaNombre caracteres.";
	        	$nombre = "";
	        }

	        if (!validarLongitudCadena($apellidos, $longitudMinimaApellidos, $longitudMaximaApellidos))
	        {
	            $errores["apellidos"] = "Los apellidos tienen que tener una longitud mínima de $longitudMinimaApellidos y máxima de $longitudMaximaApellidos caracteres.";
	            $apellidos = "";
	        }

	        if (!validarEmail($email))
	        {
	            $errores["email"] = "El correo electrónico no es válido.";
	            $email = "";
	        }
	        elseif (strlen($email)>$longitudMaximaEmail)
	        {
				$errores["email"] = "El correo electrónico del empleado no puede superar los longitudMaximaEmail caracteres.";
	            $email = "";
	        }
			
	       
	        // Género
	        if (!validarEnteroPositivo($genero))
	        {
	            $errores["genero"] = "El género es obligatorio.";
	            $sede = "";
	        }
	        
	        // Ciudad
	        if (!validarEnteroPositivo($ciudad))
	        {
	            $errores["ciudad"] = "La ciudad es obligatoria.";
	            $ciudad = "";
	        }
	        
    	}
  	?>

  	<?php
  		if (!$comprobarValidacion || count($errores) > 0):
  
  	?>
  		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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
	            <!-- Campo correo electrónico -->
	            <input type="text" name="email" placeholder="Correo electrónico" value="<?php echo $email ?>">
	            <?php
	            	if (isset($errores["email"])):
	            ?>
	            	<p class="error"><?php echo $errores["email"] ?></p>
	            <?php
	            	endif;
	            ?>
	        </p>
	        
	        <p>
	            <!-- Campo ciudad -->
	            <select id="ciudad" name="ciudad">
	            	<option value="">Seleccione Ciudad</option>
	            <?php
	            	$conexion = conectarPDO($host, $user, $password, $bbdd);

	            	$consulta = "SELECT id, ciudad FROM ciudad ORDER BY ciudad";
	            	
	            	$resultado = resultadoConsulta($conexion, $consulta);

  					while ($row = $resultado->fetch(PDO::FETCH_ASSOC)):
  				?>
  					<option value="<?php echo $row["id"]; ?>" <?php echo $row["id"] == $ciudad ? "selected" : ""?>><?php echo $row["ciudad"]; ?></option>
  				<?php
  					endwhile;

  					$consulta = null;

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
	            <!-- Campo género -->
	            <select id="genero" name="genero">
	            	<option value="">Seleccione Género</option>
	            <?php
	            	$conexion = conectarPDO($host, $user, $password, $bbdd);

	            	$consulta = "SELECT id, genero FROM genero ORDER BY genero";
	            	
	            	$resultado = resultadoConsulta($conexion, $consulta);

  					while ($row = $resultado->fetch(PDO::FETCH_ASSOC)):
  				?>
  					<option value="<?php echo $row["id"]; ?>" <?php echo $row["id"] == $genero ? "selected" : ""?>><?php echo $row["genero"]; ?></option>
  				<?php
  					endwhile;

  					$consulta = null;

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
			$insert = "insert into ficha (nombre, apellidos, email, id_ciudad, id_genero) values (:nombre,  :apellidos, :email, :ciudad, :genero)";

			// preparar la consulta
			$consulta = $conexion->prepare($insert);

			$consulta->bindParam(':nombre', $nombre);
			$consulta->bindParam(':apellidos', $apellidos); 
			$consulta->bindParam(':email', $email);
			$consulta->bindParam(':ciudad', $ciudad); 
			$consulta->bindParam(':genero', $genero);
			
			
			// ejecutar la consulta y captura de la excepcion
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

        	// redireccionamos al listado
  			header("Location: listado.php");
  			
    	endif;
    ?>
    
</body>
</html>