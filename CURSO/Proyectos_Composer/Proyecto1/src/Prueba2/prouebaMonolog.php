<?php
    require_once("../vendor/autoload.php");
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\NativeMailerHandler;

    // Crear una instancia del logger con un nombre de canal
    $log = new Logger('MiAplicacion');

    // Añadir un manejador que escribe los logs en un archivo
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));

    // Añadir un manejador que envía correos en caso de errores graves
    $mailHandler = new NativeMailerHandler(
        'admin@example.com',       // Dirección de correo destino
        'Error crítico en la app', // Asunto del correo
        'from@example.com',        // Dirección de correo origen
        Logger::ERROR              // Nivel mínimo para activar este manejador
    );
    $log->pushHandler($mailHandler);

    // Ejemplo de mensajes de log
    $log->info('Esta es una información general.'); // Sólo se escribe en el archivo
    $log->error('Ha ocurrido un error grave.');     // Se escribe en el archivo y se envía por correo
?>