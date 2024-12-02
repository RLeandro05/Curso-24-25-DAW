<?php
    require_once("CintaVideo.php");
    require_once("Juego.php"); 
    require_once("Cliente.php");

    
    //Crear objeto Soporte
    $objSoporte1 = new Soporte("DVD Blue-Ray", 12 ,  8.90);

    //Mostrar resumen del objeto
    $objSoporte1->muestraResumen();
    

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

    $objCliente->muestraResumen();
?>