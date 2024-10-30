<?php 
    // Definir constante de usuario
    define("user", "Leandro");

    // Mostrar el acceso del usuario para la compra
    echo nl2br("<b>Ha iniciado sesión: '".user."'</b>\n");

    // Definicion de constantes de descuento, el limite de descuento para aplicarlo y el limite de compra grande para inidcar si lo es
    define("DESCUENTO_PEQUENO", 0.1);
    define( "LIMITE_DESCUENTO", 50);
    define("LIMITE_COMPRA_GRANDE", 100);

    echo nl2br("-------------------------------------------------------------------------------\n");

    echo nl2br("<h2>Lista de productos</h2>\n");
    
    // Definición de matriz con productos
    $listaProductos = [
        ["nombre" => "Manzana", "cantidad" => floatval(100), "precio_unitario" => number_format(1.2, 2)],
        ["nombre" => "Pera", "cantidad" => floatval(2), "precio_unitario" => number_format(2, 2)],
        ["nombre" => "Sandia", "cantidad" => floatval(4), "precio_unitario" => number_format(2.5, 2)]
    ];

    // Mostrar la matriz en pantalla
    echo nl2br("- <b>{$listaProductos[0]["nombre"]}</b>; Cantidad: {$listaProductos[0]["cantidad"]} unidades; Precio unitario: {$listaProductos[0]["precio_unitario"]} €/u\n");
    echo nl2br("- <b>{$listaProductos[1]["nombre"]}</b>; Cantidad: {$listaProductos[1]["cantidad"]} unidades; Precio unitario: {$listaProductos[1]["precio_unitario"]} €/u\n");
    echo nl2br("- <b>{$listaProductos[2]["nombre"]}</b>; Cantidad: {$listaProductos[2]["cantidad"]} unidades; Precio unitario: {$listaProductos[2]["precio_unitario"]} €/u\n");

    echo nl2br("-------------------------------------------------------------------------------\n");

    // Mostrar el resumen de la compra
    echo nl2br("<h2>Resumen de la compra</h2>\n");
    $subtotalManzana = $listaProductos[0]["cantidad"]*$listaProductos[0]["precio_unitario"];
    $subtotalPera = $listaProductos[1]["cantidad"]*$listaProductos[1]["precio_unitario"];
    $subtotalSandia = $listaProductos[2]["cantidad"]*$listaProductos[2]["precio_unitario"];

    // Formateo de los numeros a dos decimales
    echo nl2br("<b>Subtotal ".$listaProductos[0]["nombre"]."</b>: ".number_format($subtotalManzana, 2)." €\n");
    echo nl2br("<b>Subtotal ".$listaProductos[1]["nombre"]."</b>: ".number_format($subtotalPera, 2)." €\n");
    echo nl2br("<b>Subtotal ".$listaProductos[2]["nombre"]."</b>: ".number_format($subtotalSandia, 2)." €\n");
    $subtotalCompra = $subtotalManzana+$subtotalPera+$subtotalSandia;
    echo nl2br("<b>Subtotal de todos los productos: </b>".number_format($subtotalCompra, 2)." €\n");
    
    // En caso de superar los 50€, se aplica el descuento, se muestra que se aplica y se muestra el total de la compra
    if ($subtotalCompra > LIMITE_DESCUENTO) {
        $descuento = $subtotalCompra*DESCUENTO_PEQUENO;
        echo nl2br("<b>Descuento</b>: Aplicado\n");
        $totalCompra = $subtotalCompra-$descuento;
        echo nl2br("<b>Total de la compra</b>: ".strval(number_format($totalCompra, 2)))." €";
        echo nl2br("\n");
        if ($subtotalCompra > LIMITE_COMPRA_GRANDE) {
            echo nl2br("<b>COMPRA GRANDE</b>\n");
        }
    } else { // En caso contrario, mostrar que no se aplica y poner como total de la compra la misma que el subtotal
        echo nl2br("<b>Descuento</b>: No Aplicado\n");
        echo nl2br("<b>Total de la compra</b>: ".strval(number_format($subtotalCompra, 2)))." €\n";
    }

    echo nl2br("-------------------------------------------------------------------------------\n");

    // Mostrar el cierre de seisón del usuario
    echo nl2br("<b>Ha cerrado sesión: '".user."'</b>");
?>