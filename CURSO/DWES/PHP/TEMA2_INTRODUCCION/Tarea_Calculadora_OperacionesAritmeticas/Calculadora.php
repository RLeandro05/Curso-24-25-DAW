<?php
    // Definir constantes utiles para el programa
    define("user", "Leandro");
    define("LIMITE_CANTIDAD_ADICIONAL",40);
    define("IVA", 0.15);
    define("DESCUENTO_LIMITE_CANTIDAD", 0.05);
    define("LIMITE_COMPRA_GRANDE", 100);
    define("DESCUENTO_COMPRA_GRANDE", 0.10);
    define("LIMITE_PROMOCION_ESPECIAL", 120);
    define("DIA_PROMOCION_ESPECIAL", "Jueves");

    // Mostrar usuario que inicia sesión
    echo nl2br("Usuario que inicia sesión: <b>".user."</b>\n");

    echo nl2br("-------------------------------------------------------------------------\n");

    // Matriz de productos para hacer más cómodo su uso
    echo nl2br("<h2>Lista de Productos</h2>\n");
    $listaProductos = [
        ["nombre" => "Manzanas", "cantidad" => 40, "precio_unitario" => 1.3],
        ["nombre" => "Peras", "cantidad" => 27, "precio_unitario" => 2],
        ["nombre" => "Sandias", "cantidad" => 26, "precio_unitario" => 3.4]
    ];

    // Mostrar los productos junto con su información al usuario
    echo nl2br("<b>".$listaProductos[0]["nombre"].": ".$listaProductos[0]["precio_unitario"]."€/u</b>\n");
    echo nl2br("<b>".$listaProductos[1]["nombre"].": ".$listaProductos[1]["precio_unitario"]."€/u</b>\n");
    echo nl2br("<b>".$listaProductos[2]["nombre"].": ".$listaProductos[2]["precio_unitario"]."€/u</b>\n");

    echo nl2br("-------------------------------------------------------------------------\n");

    echo nl2br("<h2>Resumen de la compra</h2>\n");

    // Mostrar el detalle de los productos escogidos
    echo nl2br("Número de ".$listaProductos[0]["nombre"].": <b>".$listaProductos[0]["cantidad"]." unidad/es</b>\n");
    echo nl2br("Número de ".$listaProductos[1]["nombre"].": <b>".$listaProductos[1]["cantidad"]." unidad/es</b>\n");
    echo nl2br("Número de ".$listaProductos[2]["nombre"].": <b>".$listaProductos[2]["cantidad"]." unidad/es</b>\n");

    // Calcular cantidad total de productos y subtotal
    $cantidadTotal = number_format($listaProductos[0]["cantidad"]+$listaProductos[1]["cantidad"]+$listaProductos[2]["cantidad"], 2);
    $subtotal = number_format(($listaProductos[0]["cantidad"]*$listaProductos[0]["precio_unitario"])+($listaProductos[1]["cantidad"]*$listaProductos[1]["precio_unitario"])+$listaProductos[2]["cantidad"]*$listaProductos[2]["precio_unitario"], 2);
    
    // En caso de superar el limite de precio, aplicar y calcular 10% de descuento
    if ($subtotal > LIMITE_COMPRA_GRANDE) {
        echo nl2br("Descuento de 10%: <b>Aplicado</b>\n");
        $subtotal = number_format($subtotal-($subtotal*DESCUENTO_COMPRA_GRANDE), 2);
        echo nl2br("Total con Descuento 10%: <b>".$subtotal." €</b>\n");
    } else {
        echo nl2br("Descuento de 10%: <b>No Aplicado</b>\n");
    }
    // En caso de superar el limite de cantidad de productos, aplicar y calcular 5% de descuento
    if ($cantidadTotal > LIMITE_CANTIDAD_ADICIONAL) {
        echo nl2br("Descuento de 5%: <b>Aplicado</b>\n");
        $subtotal = number_format($subtotal-($subtotal*DESCUENTO_COMPRA_GRANDE), 2);
        echo nl2br("Total con Descuento 5%: <b>".$subtotal." €</b>\n");
    } else {
        echo nl2br("Descuento de 5%: <b>No Aplicado</b>\n");
    }

    // Sumar un 15% al total por el IVA impuesto
    echo nl2br("IVA: <b>15%</b><br>");
    $subtotal = number_format($subtotal+($subtotal*IVA), 2);
    echo nl2br("Total con IVA: <b>".$subtotal." €</b>\n");

    // Indicar si la cantidad total de productos es par o impar
    if ($cantidadTotal % 2 == 0) {
        echo nl2br("La cantidad total de productos es <b>par</b>\n");
    } else {
        echo nl2br("La cantidad total de productos es <b>impar</b>\n");
    }

    // En caso de superar la cantidad de precio indicada en la constante y ser un dia especifico, indicar al usuario que posee un cupon de descuento del 60% para su proxima compra
    if ($subtotal > LIMITE_PROMOCION_ESPECIAL && DIA_PROMOCION_ESPECIAL == "Jueves") {
        echo nl2br("¡Enhorabuena! Por ser Jueves60 y sobrepasar los ".LIMITE_PROMOCION_ESPECIAL." € de valor de cesta, <br>le regalamos este descuento del 60% para su próxima compra \n");
    } else {
        echo nl2br("No hay promociones especiales aplicadas a la compra\n");
    }

    echo nl2br("-------------------------------------------------------------------------\n");

    // Indicar que cierre sesión el usuario
    echo nl2br("Usuario que cierra sesión: <b>".user."</b>\n");
?>