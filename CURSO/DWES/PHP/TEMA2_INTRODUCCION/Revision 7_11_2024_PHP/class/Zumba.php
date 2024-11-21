<?php 

    class Zumba { //Instanciar clase Zumba
        //Instanciar atributos de horario
        private string $horario1;
        private string $horario2;

        //Constructor
        public function __construct(string $horario1, string $horario2) {
            $this->horario1 = $horario1;
            $this->horario2 = $horario2;
        }

        //Método para obtener el valor de horario1
        public function getHorario1() {
            return $this->horario1;
        }

        //Método para insertar un nuevo valor de horario1
        public function setHorario1($horario1) {
            $this->horario1 = $horario1;
            return $this;
        }

        //Método para obtener el valor de horario2
        public function getHorario2() {
            return $this->horario2;
        }

        //Método para insertar un nuevo valor de horario2
        public function setHorario2($horario2) {
            $this->horario2 = $horario2;
            return $this;
        }
    }
    

?>