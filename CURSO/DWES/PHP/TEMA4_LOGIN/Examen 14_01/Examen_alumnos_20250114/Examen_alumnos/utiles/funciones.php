<?php
	
/**
 * FUNCIONES DE VALIDACIÓN
 */

	/**
  * Método que devuelve el valor del campo recibido como párametro
  * @param {string} $campo - Nombre del campo a comprobar en el REQUEST
  * @param {string} $valor - Valor del campo recibido como parámetro
  * @return {PDO}
  */
  function obtenerValorCampo(string $campo): string
  {
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

  /**
  * Método que valida si el campo está de texto está dentro de unos límites
  * @param {string} $texto - Texto a validar
  * @param {int} $minimo - Longitud mínimo que puede tener
  * @param {int} $maximo - Longitud máxima que puede tener
  * @return {boolean}
  */
  function validarLongitudCadena (string $texto, int $minimo, int $maximo): bool
  {
      return ((strlen($texto) >= $minimo && strlen($texto) <= $maximo) === FALSE)  ? False : True;
  }

  /**
  * Método que valida si es un número entero dentro de un rango
  * @param {string} $numero - Número a validar
  * @param {int} $limiteInferior - Límite inferior del número
  * @param {int} $limiteSuperior - Límite superior del número
  * @return {bool}
  */
  function validarEnteroRango(string $numero, int $limiteInferior , int $limiteSuperior): bool
  {
      return (filter_var($numero, FILTER_VALIDATE_INT,  ["options" => ["min_range" => $limiteInferior, "max_range" => $limiteSuperior]]) === FALSE) ? False : True;
  }


/**
 * FIN FUNCIONES DE VALIDACIÓN
 */


/**
 * FUNCIONES TRABAJAR CON BBDD
 */

  /*
  * Función que devuelve la conexión a la base de datos o JSON con error de la conexión
  * @param {array} $dbInfo - Array con la información necesaria para realizar la conexión a la base de datos
  * @return {PDO}
  */
  function conectarPDO(array $dbInfo): PDO 
  {
    try 
    {
      $mysql="mysql:host=$dbInfo[host];dbname=$dbInfo[db];charset=utf8";
      $conexion = new PDO($mysql, $dbInfo["username"], $dbInfo["password"]);
      // set the PDO error mode to exception
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    } 
    catch (PDOException $exception) 
    {
      // Obtenemos el error
      $errorDescription = $exception->getMessage();
      $datosJson = json_encode(array('error' => $errorDescription));

      // Devolvemos codigo y mensaje del error
      header ("Content-Type: application/json");
      header ("HTTP/1.1 500 Internal Server Error");
      echo $datosJson;
      exit();
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