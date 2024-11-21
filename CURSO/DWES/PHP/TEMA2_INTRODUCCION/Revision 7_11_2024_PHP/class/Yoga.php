<?php 

    class Yoga { //Instanciar clase Yoga
        //Instanciar atributos de horario
        private string $horario1;
        private string $horario2;
        private string $horario3;

        //Constructor
        public function __construct(string $horario1, string $horario2, string $horario3) {
            $this->horario1 = $horario1;
            $this->horario2 = $horario2;
            $this->horario3 = $horario3;
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

        //Método para obtener el valor de horario3
        public function getHorario3() {
            return $this->horario3;
        }

        //Método para insertar un nuevo valor de horario3
        public function setHorario3($horario3) {
            $this->horario1 = $horario3;
            return $this;
        }
    }
?>