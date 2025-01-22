<?php

//Uso de namespace
namespace DawM\Monologos;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\IntrospectionProcessor;

class HolaMonolog //Definir clase
{
    private $miLog;
    private $hora;

    public function __construct($hora)
    {
        $this->hora = $hora;

        //Crear un logger 
        $this->miLog = new Logger('VideoclubLogger');

        //Agregar el RotatingFileHandler con nivel debug 
        $this->miLog->pushHandler(new RotatingFileHandler(__DIR__, 0, Logger::DEBUG));

        //Agregar el procesador de introspección y el manejador 
        $this->miLog->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/../logs/holaMonolog.log', Logger::DEBUG));
        $this->miLog->pushProcessor(new IntrospectionProcessor());
    }

    public function saludar()
    {
        if ($this->hora < 0 || $this->hora > 24) {
            $this->miLog->warning("Hora inválida: {$this->hora}");
            return;
        }

        if ($this->hora < 12) {
            $this->miLog->info("¡Buenos días!");
        } elseif ($this->hora < 18) {
            $this->miLog->info("¡Buenas tardes!");
        } else {
            $this->miLog->info("¡Buenas noches!");
        }
    }

    public function despedir()
    {
        if ($this->hora < 0 || $this->hora > 24) {
            $this->miLog->warning("Hora inválida: {$this->hora}");
            return;
        }

        if ($this->hora < 12) {
            $this->miLog->info("¡Hasta mañana! Que tengas un buen día.");
        } elseif ($this->hora < 18) {
            $this->miLog->info("¡Hasta luego! Que tengas una buena tarde.");
        } else {
            $this->miLog->info("¡Hasta pronto! Que tengas una buena noche.");
        }
    }
}
