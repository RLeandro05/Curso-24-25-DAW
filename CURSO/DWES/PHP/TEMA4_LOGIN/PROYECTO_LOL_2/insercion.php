<?php 

//Función para conectarse a una base de datos que devuelve un objeto PDO, es decir, una conexión
function conectarPDO(string $host, string $user, string $password, string $bbdd): PDO {
    try {
        //sql en el cual tendremos el host, el nombre de la base de datos y el charset
        $mysql = "mysql:host=$host;dbname=$bbdd;charset=utf8";
        //Crear una nueva conexión PDO insertando el sql, el usuario y la contraseña pasadas
        $conexion = new PDO($mysql, $user, $password);
        //Establecer el modo de error de PDO a excepciones
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        //En caso de error por alguna excepción, dejar de ejecutar y mostrar el error
        exit($exception->getMessage());
    }

    //Devolver la conexión
    return $conexion;
}

//Variables
$host = "localhost";
$user = "root";
$passwordDB = "";
$bbdd = "lol_manana";

//Guardar en una variable la conexión devuelta de la función
$conexion = conectarPDO($host, $user, $passwordDB, $bbdd);

//Crear un array de campeones con su información
$campeones = [
    [
        "nombre" => "Sett",
        "rol" => "Tanque/Luchador",
        "dificultad" => "Baja",
        "descripcion" => "Sett es una prominente figura en los emergentes círculos criminales jonios, que aseguró su posición al inicio de la guerra con Noxus. A pesar de sus humildes comienzos como luchador en el foso de Navori, no tardó en labrarse una reputación con la ayuda de su desmesurada fuerza y su capacidad para aguantar palizas terribles. Tras abrirse paso entre los contendientes locales, Sett reina ahora por la fuerza en el foso en el que antes luchaba.",
    ],
    [
        "nombre" => "Seraphine",
        "rol" => "Asitencia/Mago",
        "dificultad" => "Baja",
        "descripcion" => "Seraphine, de padres zaunitas, nació en Piltover y es capaz de escuchar las almas de los demás. El mundo le canta y ella le devuelve la canción. Aunque esos sonidos le resultaban abrumadores cuando era pequeña, ahora le sirven de inspiración, y transforma el caos en una sinfonía. Actúa para ambas ciudades con la intención de recordarles a sus ciudadanos que no están solos, que la unión hace la fuerza y que, a los ojos de Seraphine, su potencial es infinito.",
    ],
    [
        "nombre" => "Volibear",
        "rol" => "Luchador/Tanque",
        "dificultad" => "Baja",
        "descripcion" => "Para aquellos que aún lo veneran, Volibear es la encarnación de la tormenta. Destructivo, salvaje y decidido, existe desde antes de que los mortales pusieran pie en las tundras de Freljord y protege con fiereza las tierras que creó junto a sus hermanos semidioses. Ha desarrollado un profundo odio por la civilización y la debilidad que, a sus ojos, ha traído consigo, y lucha para regresar a las costumbres de antaño, cuando la tierra era salvaje y la sangre fluía sin reparos. Con sus dientes, sus garras y su atronadora presencia, acaba con todo aquel que se oponga a su visión.",
    ],
    [
        "nombre" => "Aurora",
        "rol" => "Mago/Asesino",
        "dificultad" => "Media",
        "descripcion" => "Desde que nació, Aurora ha tenido una visión única de la vida gracias a su capacidad para moverse entre los reinos material y espiritual. Decidida a conocer mejor a los habitantes del reino espiritual, abandonó su hogar para ampliar sus conocimientos, hasta que se topó con un semidiós errante que había sucumbido a la oscuridad, perdiéndose así en el tiempo. Al ver su desesperación, Aurora se propuso ayudar a su feroz amigo a recuperar su identidad olvidada en un viaje que la llevaría hasta los lugares más recónditos de Freljord.",
    ],
    [
        "nombre" => "Darius",
        "rol" => "Luchador/Tanque",
        "dificultad" => "Baja",
        "descripcion" => "No hay mayor símbolo del poder de Noxus que Darius, el comandante más temido y más curtido en batallas de toda la nación. Pasando de orígenes humildes a convertirse en la Mano de Noxus, se abre paso a tajos entre los enemigos del imperio, muchos de ellos noxianos. Sabiendo que él nunca duda que su causa sea justa ni tampoco duda cuando levanta su hacha, aquellos que se oponen al comandante de la legión trifariana no encontrarán piedad.",
    ]
];

//Preparar la consulta para insertar campeones
$sql = "INSERT INTO campeon (nombre, rol, dificultad, descripcion) 
        VALUES (:nombre, :rol, :dificultad, :descripcion)";

//Preparar la consulta insertandon en prepare el sql
$consulta = $conexion->prepare($sql);

//Recorrer los campeones y ejecutar la inserción por cada campeón del array
foreach ($campeones as $campeon) {
    $consulta->execute([
        ":nombre" => $campeon["nombre"],
        ":rol" => $campeon["rol"],
        ":dificultad" => $campeon["dificultad"],
        ":descripcion" => $campeon["descripcion"]
    ]);
}

//Mostrar resultado satisfactorio
echo "Datos insertados correctamente.";
?>
