<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los numeros del formulario
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];

    // Verificamos que sena numeros validos
    if (is_numeric($numero1) && is_numeric($numero2)) {
        // Realizamos la suma
        $suma = $numero1 + $numero2;

        // Mostramos el resultado
        echo "<h2>Resultado de la suma:</h2>";
        echo "<p>La suma de $numero1 + $numero2 es: $suma</p>";
    } else {
        echo "<p>Por favor, ingresa valores numericos validos.</p>";
    }
} else {
    echo "<p>Error al procesar la solicitud</p>";
}
?>