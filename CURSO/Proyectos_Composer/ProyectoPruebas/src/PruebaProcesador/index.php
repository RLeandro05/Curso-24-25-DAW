<?php

    require_once("../../vendor/autoload.php");

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    // Crear un logger
    $logger = new Logger('app');
    $logger->pushHandler(new StreamHandler('logs/app.log', Logger::DEBUG));

    // Crear un procesador para añadir el ID del usuario
    $logger->pushProcessor(function ($record) {
        $record['extra']['user_id'] = 123;  // Añadir información adicional
        return $record;
    });

    // Generar un mensaje de prueba
    $logger->info('Este es un mensaje informativo');
    $logger->error('Este es un mensaje de error crítico');
?>