<?php
    //Number format para pasar al español
    $number = 1234.45;
    $nuevo = number_format($number, 2, ",", ".");
    echo nl2br($number."\n");
    echo $nuevo;

    //Definir Constante
    define("user", "Leandro");
    echo "<br>";
    echo user;

    //Definir matriz bidimensional y mostrar elemento concreto
    $matrizBi = [
        ["elemento1" => "valor1"],
        ["elemento2" => "valor2"],
        ["elemento3" => "valor3"]
    ];

    echo "<br>";
    echo $matrizBi[1]["elemento2"];
    echo "{$matrizBi[0]["elemento1"]}";

    //Número aleatorio
    $aleatorio = mt_rand(1, 4);
    echo "<br>";
    echo $aleatorio;

    //Imprimir un array completo
    echo "<pre>";
    print_r($matrizBi);
    echo "</pre>";

    //Saber si un campo existe o tiene valor
    if(isset($aleatorio)) {
        echo "Existe";
    } else {
        echo "No existe";
    }

    //Recoger valores de un formulario
    //$respuestaForm = $_POST/$_GET/$_REQUEST

    //Recoger valor específico de un formulario (OJO, DEBE TENER ATRIBUTO name EN EL ELEMENTO ENVIADO)
    //$valor = $_POST/$_GET/$_REQUEST["valor"]

    //Emoticono
    $emoticono = rand(128512, 128586);
    echo "<p>Emoticono: &#$emoticono</p>";

    //Fusionar arrays
    $array1 = ["Pan"];
    $array2 = ["Huevo"];
    $arrayFusion = array_merge($array1, $array2);

    //Eliminar elementos de un array que ya existen en otro
    $array1 = ["Pan, Huevo, Manteca"];
    $array1 = ["Mostaza, Pan, Huevo"];
    $arrayDiff = array_diff($array2, $array1); //El primer array dentro del paréntesis es al que se le eliminan los elementos

    //Hacer un forEach
    $arraybi = [
        ["elemento1" => "valor1", "elemento2" => "valor2"],
        ["element3" => "valor3", "elemento4" => "valor4"],
        ["elemento5" => "valor5", "elemento6" => "valor6"]
    ];

    $array = ["elemento1" => "valor1", "elemento2" => "valor2"];

    foreach ($arraybi as $key => $valor) { //forEach con bidimensional
        echo "<pre>";
        print_r($valor);
        echo "</pre>";
    }

    foreach ($array as $key) { //forEach con unidimensional
        echo $key." ";
    }

    //Verificar si un elemento se encuentra en un array
    $estaenArray = in_array("elemento1", $array);

    //Iniciar sesión
    session_start();

    //Eliminar todos los atributos de session
    session_unset();

    //Destruir o acabar sesión
    session_destroy();

    //Añadir un atributo a session
    $_SESSION["atributo"] = "valor";

    //Eliminar atributo específico
    unset($_SESSION["atributo"]);

    //Sacar el tipo de método de un formulario
    $_SERVER["REQUEST_METHOD"];

    //Usar time en sesiones
    $_SERVER["tiempo"] = time();

    //Parar ejecución del código
    exit();

    //Cabecera de .txt
    header("Content-Type: text/plain");
    header('Content-Disposition: attachment; filename="saludo.txt"');
    echo "Hola. Este es el contenido predefinido del archivo 'saludo.txt'";

    //Cabecera de .pdf, usando FPDF
    require __DIR__ . "/../../vendor/autoload.php";

    use Fpdf\Fpdf;

    $nombreArchivo = "saludo.pdf";

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$nombreArchivo.'"');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Hola Mundo'); // Añade un ancho y alto para la celda
    $pdf->Output('D', $nombreArchivo); // 'D' para forzar la descarga

    //Cabecera de jpeg
    $imagen = 'homerJPG.jpg'; // Ruta de la imagen

    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="homerJPEG.jpeg"');

    readFile($imagen);

    //Cabecera de png
    $imagen = 'homerJPG.jpg'; // Ruta de la imagen

    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="homerPNG.png"');

    readFile($imagen);

    //Cabecera de gif
    $imagen = 'homerJPG.jpg'; // Ruta de la imagen

    header('Content-Type: image/gif');
    header('Content-Disposition: attachment; filename="homerGIF.gif"');

    readFile($imagen);

    //Cabecera de .zip, usando PHPZip
    require '../../vendor/autoload.php'; // Requerido el autorload.php para poder crear el zip

    // Implementar las cabeceras con el tipo ZIP
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="archivos.zip"');

    $zip = new \PhpZip\ZipFile(); // Crear un nuevo \PhpZip\ZipFile

    // Agregar archivos al ZIP
    $zip->addFile('homerGIF.gif');
    $zip->addFile('ejemplo.html');

    $zip->saveAsFile("archivos.zip"); // Guardar el archivo zip EN UNA RUTA ESPECÍFICA

    readfile("archivos.zip"); // Leer el archivo una vez guardado

    //$zip->close(); OPCIONAL
?>