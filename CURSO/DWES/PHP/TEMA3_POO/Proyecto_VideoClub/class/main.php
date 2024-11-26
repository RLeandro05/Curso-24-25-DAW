<?php
    require_once("CintaVideo.php"); //Incluir la clase que se va a usar

    /*
    //Crear objeto Soporte
    $objSoporte1 = new Soporte("DVD Blue-Ray", 12 ,  8.90);

    //Mostrar resumen del objeto
    $objSoporte1->muestraResumen();
    */

    //Crear objeto CintaVideo
    $objCV = new CintaVideo("DVD Blue-Ray", 12 ,  8.90, 120);

    //Mostrar resumen del objeto
    $objCV->muestraResumen();
?>