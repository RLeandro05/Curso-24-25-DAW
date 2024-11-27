<?php
    session_start(); // Iniciar sesión

    require_once("program.php"); // Para usar globalmente desde su archivo la matriz de productos

    // Cerrar sesión y volver a la página de inicio en caso de pinchar en dicho botón
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cierraSesion"])) {
        session_destroy();
        header('Location: index.php');
        exit();
    } 
    
    // Mostrar lo que se seleccionó para depuración
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["prendaSeleccionada"])) {
        agregar_producto($_POST["prendaSeleccionada"], 1);
    }

    if (isset($_SESSION["usuario"])) { // Asegurarse de que existe el usuario iniciado
        echo nl2br("<h2>¡Bienvenido, ".$_SESSION['usuario']."!</h2>\n");
        echo nl2br("A continuación, se le presenta la lista de productos: \n");

        // Guardar en una variable la matriz global de productos
        $listaProductos = $_SESSION["listaProductos"];

        echo "<form action=\"main.php\" method=\"post\">";

        // Mostrar por cada categoría de persona, sus productos e información del mismo
        foreach ($listaProductos as $categoria => $infoCategoria) {
            echo nl2br("<u>Ropa de <b>'".$categoria."'</b></u>: \n\n");

            // Mostrar productos dentro de cada categoría
            foreach ($listaProductos[$categoria] as $categoriaProductos => $infoProductos) {
                echo nl2br("Categoría <b><u>".$categoriaProductos.": </u></b>\n");
                echo nl2br("----------\n");

                // Mostrar cada producto en la categoría correspondiente
                foreach ($infoProductos as $producto) {
                    echo "<p>";
                    // Usar un checkbox o radio para permitir seleccionar un producto
                    echo nl2br("<input type=\"checkbox\" name=\"prendaSeleccionada[]\" value=\"".$producto['nombre']."\" id=\"prenda_".$producto['nombre']."\">");
                    echo nl2br("<label for=\"prenda_".$producto['nombre']."\">Prenda: ".$producto['nombre']."</label>\n");
                    echo nl2br("Precio: ".number_format($producto["precio"], 2, ",", ".")." €\n");
                    echo "<input type=\"submit\" value=\"Agregar al carrito\">";
                    echo "</p>";
                    echo nl2br("-----\n");
                }
                
                echo nl2br("\n");
            }

            echo nl2br("\n\n");
            echo nl2br("----------------------------------------------");
            echo nl2br("\n\n");
        }

        // Botones para cerrar sesión y ver el carrito
        echo "<input type=\"submit\" name=\"cierraSesion\" value=\"Cerrar Sesión\"> ";
        echo "<input type=\"submit\" value=\"Ver Carrito\">";

        echo "</form>";
    }
?>
