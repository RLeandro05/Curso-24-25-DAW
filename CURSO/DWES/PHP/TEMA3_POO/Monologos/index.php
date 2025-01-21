<?php
    require_once("vendor/autoload.php");
    
    use DawM\Monologos\HolaMonolog;

    $saludo = new HolaMonolog(13);

    $saludo->saludar();
?>