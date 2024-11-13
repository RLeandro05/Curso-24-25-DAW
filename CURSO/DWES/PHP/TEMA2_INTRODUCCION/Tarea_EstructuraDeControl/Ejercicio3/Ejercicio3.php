<?php 
    $total = 1;
    $num = mt_rand(1, 10); // Numero aleatorio de ejemplo
    for ($i = $num;$i >= 1; $i--) { // for que multiplica por el siguiente valor -1
        $total = number_format($total*$i, 2);
    }

    // Mostrar el resultado
    echo nl2br("Resultado del factorial de '$num': '$total'")
?>