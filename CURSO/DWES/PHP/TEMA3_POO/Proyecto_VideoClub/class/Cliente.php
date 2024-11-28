<?php
class Cliente
{ //Instanciar clase
    //Instanciar atributos
    public string $nombre;
    private int $numero;
    private array $soportesAlquilados = [];
    private int $numSoportesAlquilados = 0;
    private int $maxAlquilerConcurrente;

    //Constructor para crear objetos
    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    //Función para obtener el valor del nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    //Función para obtener el valor del número
    public function getNumero()
    {
        return $this->numero;
    }

    //Función para insertar un valor del número
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    //Función para obtener el valor de maxAlquilerConcurrente
    public function getMaxAlquilerConcurrente()
    {
        return $this->maxAlquilerConcurrente;
    }

    //Método para alquilar un nuevo soporte
    public function alquilar(Soporte $soporte)
    {
        //Comprobar si el cliente ya tiene alquilados el número máximo de soportes
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            echo nl2br("Has alcanzado el límite de alquileres concurrentes.\n");
            return;
        }

        //Asegurarse de si existe ya el soporte
        if ($this->tieneAlquilado($soporte)) {
            return "El soporte no está alquilado en tu lista de soportes";
        } else {
            echo nl2br("El soporte no está en tu lista de soportes");
        }
        $this->tieneAlquilado($soporte);

        //Alquilar el soporte agregándolo al array de soportes alquilados
        $this->soportesAlquilados[] = $soporte;

        //Incrementar el contador de soportes alquilados
        $this->numSoportesAlquilados++;

        echo "Soporte alquilado con éxito.";
    }

    //Método para asegurar si ya existe el soporte seleccionado en la lista
    public function tieneAlquilado(Soporte $soporte): bool{
        if (in_array($soporte, $this->soportesAlquilados)) {
            return true;
        }

        return false;
    }

    //Método para devolver soportes
    public function devolver(int $numSoporte): bool {

        //Recorrer la lista de soportes alquildos
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero === $numSoporte) {
                //En el caso de encontrar el soporte, eliminarlo de la lista
                unset($this->soportesAlquilados[$key]);

                return true;
            }
        }

        //Si no está, devuelve false
        return false;
    }

    //Método para listar el número de alquileres del cliente y su información
    public function listarAlquileres(): void {
        
    }
}
