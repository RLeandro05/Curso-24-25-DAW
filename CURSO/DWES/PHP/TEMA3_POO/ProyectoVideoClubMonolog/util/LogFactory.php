<?php
    namespace DawM\util;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

    class LogFactory {
        public static function getLogger(string $canal, string $ubicacion): LoggerInterface {
            //Crear un logger 
            $miLog = new Logger('VideoclubLogger');

            //Agregar el RotatingFileHandler con nivel debug 
            $miLog->pushHandler(new RotatingFileHandler(__DIR__, 0, Logger::DEBUG));

            //Agregar el procesador de introspección y el manejador 
            $miLog->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/../logs/videoclub.log', Logger::DEBUG));

            return $miLog;
        }
    }
?>