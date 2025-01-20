<?php
namespace Dwes\Ejemplos\Util;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogFactory {

    public static function getLogger(string $canal = "miApp") : Logger {
        $log = new Logger($canal);
        $log->pushHandler(new StreamHandler("logs/miApp.log", Logger::DEBUG));

        return $log;
    }
}
