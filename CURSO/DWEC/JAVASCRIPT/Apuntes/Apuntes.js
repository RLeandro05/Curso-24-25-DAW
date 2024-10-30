// Función para sacar número aleatorio entero
Math.floor(Math.random() * (max - min + 1)) + min;

// Función para clonar nodos. El true es para copiar todo, es decir, contenido, atributos e hijos,
// mientras que false será vacío, es decir, sólo tendrá la etiqueta y listo
let elemento = document.createElement("input");
let elementoClonado = elemento.cloneNode(true); // o (false)

// ¿Cómo intercambiar valores en value si tiene uno por defecto?
let nuevoValor = elemento.value;
elemento.value = nuevoValor;

// ¿Cómo guardar variables de eventos en teclas?
function ejemplo(evento) {
    codigoChar = evento.charCode; // Es un ejemplo, pero para cualquier atributo, se hace igual. 
                                  // Traer una variable anónima y usar uno de sus atributos para guardarlo en una nueva variable
}

// Área de un rectángulo
let areaRectangulo = base * altura;

// Área de un triángulo
let areaTriangulo = (base*altura)/2;

// Área de un círculo
let areaCirculo = Math.PI*Math.pow(radio, 2);

// Volumen de una caja
let volumenCaja = base*altura*profundidad;

// Volumen de un cilindro
let volumenCilindro = Math.PI*Math.pow(radio, 2)*altura;

// Volumen de una esfera
let volumenEsfera = (4*Math.PI*Math.pow(radio, 3))/3;

// Función de exponente
Math.pow(num, exponente);

// Función de número PI
Math.PI;

// Función para Raíz Cuadrada
Math.sqrt(numero);