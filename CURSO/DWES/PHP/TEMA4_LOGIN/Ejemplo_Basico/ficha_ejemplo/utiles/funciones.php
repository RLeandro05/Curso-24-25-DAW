<?php
	
/**
 * FUNCIONES DE VALIDACIÓN
 */

	/*
    * Función que devuelve el valor del campo recibido como párametro
    * @param {string} $campo - Nombre del campo a comprobar en el REQUEST
    * @param {string} $valor - Valor del campo recibido como parámetro
    */
    function obtenerValorCampo(string $campo): string{
        // Comprobamos si nos llega el nombre del campo en el REQUEST
        if (!isset($_REQUEST[$campo])) 
        {
          $valor = "";
        } 
        else 
        {
          // Limpiamos el campo de etiquetas y espacios
          $valor = trim(strip_tags($_REQUEST[$campo]));
        }
        return $valor;
    }

    /*
    * Método que valida si el campo está de texti está dentro de los límites indicado
    * tiene una longitud mínima de tres caracteres
    * @param {string} $texto - Texto a validar
    * @param {int} $minimo - Longitud mínimo que puede tener
    * @param {int} $maximo - Longitud máxima que puede tener
    * @return {boolean}
    */
    function validarLongitudCadena (string $texto, int $minimo, int $maximo): bool
    {
      $validacion = false;
      if(strlen($texto) >= $minimo && strlen($texto) <= $maximo)
      {
        $validacion = true;
      }
      return $validacion;
    }

    /*
    * Método que valida si es un número entero es positivo 
    * @param {string} - Número a validar
    * @return {bool}
    */
    function validarEnteroPositivo(string $numero): bool
    {
        return (filter_var($numero, FILTER_VALIDATE_INT) === FALSE || $numero <= 0) ? False : True;
    }


    /*
    * Método que valida si el texto tiene un formato válido de E-Mail
    * @param {string} - Email
    * @return {bool}
    */
    function validarEmail(string $texto): bool
    {
        return (filter_var($texto, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
    }

    /*
    * Método que valida si es un número entero y está entre unos límites
    * @param {string} - $numero Número a validar
    * @param {int} - $limiteInferior Límite inferior
    * @param {int} - $limiteSuperior Límite superior
    * @param {string} - Número a validar
    * @return {bool}
    */
    function validarEnteroLimites(string $numero, int $limiteInferior , int $limiteSuperior): bool
    {
        return (filter_var($numero, FILTER_VALIDATE_INT,  ["options" => ["min_range" => $limiteInferior, "max_range" => $limiteSuperior]]) === False) ? False : True;
    }

    /*
    * Método que valida si es un número decimal positivo
    * @param {string} - Número a validar
    * @return {bool}
    */
    function validarDecimalPositivo(string $numero): bool
    {
        return (filter_var($numero, FILTER_VALIDATE_FLOAT) === FALSE || $numero <= 0) ? False : True;
    }


/**
 * FIN FUNCIONES DE VALIDACIÓN
 */


/**
 * FUNCIONES TRABAJAR CON BBDD
 */
	

    function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO 
    {
        try 
        {
          $mysql="mysql:host=$host;dbname=$bbdd;charset=utf8";
          $conexion = new PDO($mysql, $user, $password);
          // set the PDO error mode to exception
          $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        } 
        catch (PDOException $exception) 
        {
           exit($exception->getMessage());
        }
        return $conexion;    
    }


	
	function resultadoConsulta (PDO $conexion, string $consulta): PDOStatement 
    {
		$resultado = $conexion->query($consulta);
		return $resultado;
	}


/**
 * FIN FUNCIONES TRABAJAR CON BBDD
 */

	
?>