<?php
    // Definir array de Inventario Actual
    $inventario_actual = [
        ["producto" => "Teclado", "precio" => 20, "categoria" => "Electrónica", "cantidad" => 4],
        ["producto" => "Ratón", "precio" => 15, "categoria" => "Electrónica", "cantidad" => 10],
        ["producto" => "Monitor", "precio" => 100, "categoria" => "Electrónica", "cantidad" => 3],
        ["producto" => "Silla", "precio" => 80, "categoria" => "Muebles", "cantidad" => 5],
    ];

    // Mostrar array de Inventario actual para asegurar
    echo "<pre>Inventario Actual-";
    print_r($inventario_actual);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Definir array de Inventario Proveedor_A
    $proveedor_a = [
        ["producto" => "Ratón", "precio" => 10, "categoria" => "Electrónica", "cantidad" => 20],
        ["producto" => "Lámpara", "precio" => 25, "categoria" => "Iluminación", "cantidad" => 15],
        ["producto" => "Escritorio", "precio" => 50, "categoria" => "Muebles", "cantidad" => 2],
    ];

    // Mostrar array de Inventario Proveedor_A para asegurar
    echo "<pre>Inventario Proveedor A-";
    print_r($proveedor_a);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Definir array de Inventario Proveedor_B
    $proveedor_b = [
        ["producto" => "Monitor", "precio" => 92, "categoria" => "Electrónica", "cantidad" => 8],
        ["producto" => "Auriculares", "precio" => 30, "categoria" => "Electrónica", "cantidad" => 20],
        ["producto" => "Lámpara", "precio" => 20, "categoria" => "Iluminación", "cantidad" => 5],
    ];

    // Mostrar array de Inventario Proveedor_B para asegurar
    echo "<pre>Inventario Proveedor B-";
    print_r($proveedor_b);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Comparar Inventarios entre ambos proveedores
    $productosComunes = [];

    foreach($proveedor_a as $producto_a) {
        foreach($proveedor_b as $producto_b) { // Dentro de ambos foreach de proveedores, comparar ambos productos. Si uno está en el otro, se guardará en la lista de comunes
            if($producto_a["producto"] === $producto_b["producto"]) {
                $productosComunes[] = [ // Añadir en el nuevo array la comparación de precios y cantidades
                    "producto" => $producto_a['producto'],
                    "precio_proveedor_a" => $producto_a['precio'],
                    "precio_proveedor_b" => $producto_b['precio'],
                    "categoria" => $producto_a['categoria'],
                    "cantidad_proveedor_a" => $producto_a['cantidad'],
                    "cantidad_proveedor_b" => $producto_b['cantidad'],
                ];
            }
        }
    }

    // Mostrar Inventario de productos comunes para asegurar
    echo "<pre>Inventario Productos Comunes-";
    print_r($productosComunes);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");
    

    // Unir y Organizar ambos inventarios de proveedores
    $inventarioProveedoresUnidos = array_merge($proveedor_a, $proveedor_b);

    // Mostrar Inventario Unido para asegurar
    echo "<pre> Inventario Unido de ambos Proveedores Ordenado en \"ProveedorA-ProveedorB\"-";
    print_r($inventarioProveedoresUnidos);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Eliminar productos duplicados de proveedores
    $productosEliminados = [];

    foreach($proveedor_a as $indice_a => $producto_a) { // La expresion "$indice => producto", se refiere al indica que itera y el valor correspondiente de esa posicion en el array
        foreach($proveedor_b as $indice_b => $producto_b) { // Dentro de ambos foreach de proveedores, comparar ambos productos. Si uno está en el otro, se guardará en la lista de comunes
            if($producto_a["producto"] === $producto_b["producto"]) {
                $productosEliminados[] = [ // Añadir en el nuevo array la comparación de precios y cantidades
                    "producto" => $producto_a['producto'],
                    "precio_proveedor_a" => $producto_a['precio'],
                    "precio_proveedor_b" => $producto_b['precio'],
                    "categoria" => $producto_a['categoria'],
                    "cantidad_proveedor_a" => $producto_a['cantidad'],
                    "cantidad_proveedor_b" => $producto_b['cantidad'],
                ];
                unset($proveedor_a[$indice_a]);
                unset($proveedor_b[$indice_b]);
            }
        }
    }

    // Mostrar lista de productos eliminados entre ambos inventarios de proveedores y luego demostrar que se eliminaron los repetidos de dichos inventarios
    echo "<pre> Inventario de Productos Eliminados-";
    print_r($productosEliminados);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");

    echo "<pre> Inventario de Proveedor A tras eliminar duplicados-";
    print_r($proveedor_a);
    echo nl2br("-------------------------\n");
    echo "Inventario de Proveedor B tras eliminar duplicados-";
    print_r($proveedor_b);
    echo "</pre>";

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Guardar en sus respectivas categorias los productos actuales en ellas
    define("ELECTRONICA", "Electrónica");
    define("ILUMINACION", "Iluminación");
    define("MUEBLES", "Muebles");
    $listaElectronica = [];
    $listaIluminacion = [];
    $listaMueble = [];

    foreach ($inventario_actual as $producto) {
        switch ($producto["categoria"]) {
            case ELECTRONICA:
                $listaElectronica[] = $producto;
                break;
            case ILUMINACION:
                $listaIluminacion[] = $producto;
                break;
            case MUEBLES:
                $listaMueble[] = $producto;
                break;
        }
    }

    // Hacer el conteo de productos de cada lista de categorias
    echo nl2br("<pre>Numero de productos en la tienda de la categoria ".ELECTRONICA.": ".count($listaElectronica)." producto/s\n");
    echo nl2br("<pre>Numero de productos en la tienda de la categoria ".ILUMINACION.": ".count($listaIluminacion)." producto/s\n");
    echo nl2br("<pre>Numero de productos en la tienda de la categoria ".MUEBLES.": ".count($listaMueble)." producto/s\n");

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Ordenar los productos de Inventario Actual por precio
    usort($inventario_actual, function($a, $b) {
        return $a["precio"] <=> $b["precio"];
    });

    echo nl2br("<pre>Productos de Inventario Actual ordenados por precio-\n");
    print_r($inventario_actual);
    echo nl2br("</pre>");

    echo nl2br("-------------------------\n");

    // Ordenar los productos de Proveedor A por precio
    usort($proveedor_a, function($a, $b) {
        return $a["precio"] <=> $b["precio"];
    });

    echo nl2br("<pre>Productos de Proovedor A ordenados por precio-\n");
    print_r($proveedor_a);
    echo nl2br("</pre>");

    echo nl2br("-------------------------\n");

    // Ordenar los productos de Proveedor B por precio
    usort($proveedor_b, function($a, $b) {
        return $a["precio"] <=> $b["precio"];
    });

    echo nl2br("<pre>Productos de Proveedor B ordenados por precio-\n");
    print_r($proveedor_b);
    echo nl2br("</pre>");

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Dividir el Inventario Actual de la tienda en secciones de dos elementos cada uno
    $seccion1 = [];
    $seccion2 = [];
    $contadorElementos = 0;

    // Crear tantas secciones como productos de a dos existan
    foreach ($inventario_actual as $productoA) {
        $contadorElementos++;
        if ($contadorElementos > 2) {
            $seccion2[] = $productoA;
        } else {
            $seccion1[] = $productoA;
        }
    }

    // Mostrar ambas secciones para asegurar
    echo nl2br("<pre>Seccion 1 de la tienda-\n");
    print_r($seccion1);
    echo nl2br("</pre>");

    echo nl2br("-------------------------\n");

    echo nl2br("<pre>Seccion 2 de la tienda-\n");
    print_r($seccion2);
    echo nl2br("</pre>");

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Buscar un producto al azar en el inventario de la tienda y comprobar si existe
    $productoAleatorio = "Ratón";
    $booleano = false;

    // Con el foreach, asegurar si existe el producto mencionado
    foreach ($inventario_actual as $producto) {
        if ($producto["producto"] === $productoAleatorio) {
            echo nl2br("<pre>El producto ".$productoAleatorio." se encuentra en la tienda. Aquí su información-");
            print_r($producto);
            echo nl2br("</pre>");
            $booleano = true;
        }
    }
    // Mencionar error en caso de no existir
    if (!$booleano) {
        echo nl2br("El producto ".$productoAleatorio." no se encuentra actualmente en la tienda.\n");
    }

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Reindexar los inventarios de ambos proveedores, es decir, los modificados
    $proveedor_a = array_values($proveedor_a);
    $proveedor_b = array_values($proveedor_b);

    // Mostrar inventario de ambos proveedores modificados para asegurar su cambio de índices
    echo nl2br("<pre>Inventario de Proveedor A reindexado tras realizar modificaciones-");
    print_r($proveedor_a);
    echo nl2br("</pre>");

    echo nl2br("-------------------------\n");

    echo nl2br("<pre>Inventario de Proveedor B reindexado tras realizar modificaciones-");
    print_r($proveedor_b);
    echo nl2br("</pre>");

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Ordenar por secciones más manejables. Por ejemplo, por categoria

    $seccionElectronica = [];
    $seccionIluminacion = [];
    $seccionMueble = [];

    // A partir del inventario de la tienda, guardar en distintas categorías los productos
    foreach ($inventario_actual as $producto) {
        switch ($producto["categoria"]) {
            case ELECTRONICA:
                $seccionElectronica[] = $producto;
                break;
            case ILUMINACION:
                $seccionIluminacion[] = $producto;
                break;
            case MUEBLES:
                $seccionMueble[] = $producto;
                break;
        }
    }

    // Mostrar las secciones creadas para mostrar el manejo de secciones más cómoda y manejable
    echo nl2br("<pre>Seccion de ".ELECTRONICA." de la tienda-");
    print_r($seccionElectronica);
    echo nl2br("</pre>");

    echo nl2br("-------------------------\n");

    echo nl2br("<pre>Seccion de ".ILUMINACION." de la tienda-");
    print_r($seccionIluminacion);
    echo nl2br("</pre>");

    echo nl2br("-------------------------\n");

    echo nl2br("<pre>Seccion de ".MUEBLES." de la tienda-");
    print_r($seccionMueble);
    echo nl2br("</pre>");

    echo nl2br("--------------------------------------------------------------------------------\n");

    // Realizar un informe más detallado y estadístico
    foreach ($inventario_actual as $producto) {
        echo nl2br("Producto: <b>".$producto["producto"]."</b>\n");
        echo nl2br("Precio por unidad: <b>".$producto["precio"]." €</b>\n");
        echo nl2br("Categoría del producto: <b>".$producto["categoria"]."</b>\n");
        echo nl2br("Existencias del producto: <b>".$producto["cantidad"]." unidades</b>\n");
        echo nl2br("Precio total de todas las unidades del producto: <b>".$producto["precio"]*$producto["cantidad"]." €</b>\n");
        echo nl2br("-------------------------\n");
    }

    echo nl2br("--------------------------------------------------------------------------------\n");
?>