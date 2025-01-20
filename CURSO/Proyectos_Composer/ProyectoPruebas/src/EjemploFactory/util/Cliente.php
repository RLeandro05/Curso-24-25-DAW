<?php
namespace Dwes\Ejemplos\Model;

use Dwes\Ejemplos\Util\LogFactory;
use Monolog\Logger;

class Cliente {
    private $codigo;
    private Logger $log;

    public function __construct($codigo) { 
        $this->codigo = $codigo;
        $this->log = LogFactory::getLogger();
        $this->log->info("Cliente con código {$this->codigo} ha sido creado.");
    }

    public function obtenerCodigo() {
        return $this->codigo;
    }
}
