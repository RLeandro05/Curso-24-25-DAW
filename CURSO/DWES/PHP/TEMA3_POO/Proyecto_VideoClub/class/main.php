<?php
    require_once("CintaVideo.php");
    require_once("Juego.php"); 
    require_once("Cliente.php");
    require_once("VideoClub.php");

    
    //Crear objeto Soporte
    $objSoporte1 = new Juego("Mario Party Super Star", 12 ,  59.99, "Nintendo Switch", 1, 4);

    //Mostrar resumen del objeto
    //$objSoporte1->muestraResumen();
    

    /*
    //Crear objeto CintaVideo
    $objCV1 = new CintaVideo("DVD Blue-Ray", 12 ,  8.90, 120);

    //Mostrar resumen del objeto
    $objCV1->muestraResumen();
    */

    /*
    //Crear objeto Juego
    $objJuego1 = new Juego("God Of War Ragnarok", 1, 59.99, "PS5", 1, 1);

    //Mostrar resumen del objeto
    $objJuego1->muestraResumen();
    */

    //Crear Objeto Cliente
    $objCliente = new Cliente("Leandro", 5);

    $objCliente->alquilar($objSoporte1);


    //Crear objeto VideoClub
    $objVideoClub = new VideoClub();

    $objVideoClub->incluirProducto($objSoporte1);
    $objVideoClub->incluirSocio($objCliente);

    $objVideoClub->listarProductos();
    $objVideoClub->listarSocios();
?>