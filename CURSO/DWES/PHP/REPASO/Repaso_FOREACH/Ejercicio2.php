<?php
    require_once "Data.php";

    //Actividad 2: Mostrar todas las capitales y sus poblaciones

    foreach ($comunidades as $comunidad => $info) {
        foreach ($info["capital"] as $capital => $infoCapital) {
            echo nl2br($capital." || ".$infoCapital["poblacion"]."\n");
        }
    }
?>