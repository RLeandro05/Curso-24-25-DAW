//Número aleatorio
Math.floor(Math.random() * (max - min + 1)) + min;

//--------------------------------------------------------

//Clonar nodos enteros con true
let elemento = document.createElement("input");
let elementoClonado = elemento.cloneNode(true); //Clona todo el elemento, incluyendo atributos y contenido

//--------------------------------------------------------

//Clonar etiqueta de un nodo con false
let elemento2 = document.createElement("input");
let elementoClonado2 = elemento2.cloneNode(false); //Clona sólo la etiqueta vacía del elemento, sin atributos y contenido

//--------------------------------------------------------

//Intercambiar valores
let nuevoValor = elemento.value;
elemento.value = nuevoValor;

//--------------------------------------------------------

//Área de un rectángulo
let areaRectangulo = base * altura;

//--------------------------------------------------------

//Área de un triángulo
let areaTriangulo = (base*altura)/2;

//--------------------------------------------------------

//Área de un círculo
let areaCirculo = Math.PI*Math.pow(radio, 2);

//--------------------------------------------------------

//Volumen de una caja
let volumenCaja = base*altura*profundidad;

//--------------------------------------------------------

//Volumen de un cilindro
let volumenCilindro = Math.PI*Math.pow(radio, 2)*altura;

//--------------------------------------------------------

//Volumen de una esfera
let volumenEsfera = (4*Math.PI*Math.pow(radio, 3))/3;

//--------------------------------------------------------

//Calcular potencia
Math.pow(num, exponente);

//--------------------------------------------------------

//Sacar número PI
Math.PI;

//--------------------------------------------------------

//Calcular Raíz Cuadrada
Math.sqrt(numero);

//--------------------------------------------------------

//Truncar un número
Math.trunc(numero);

//--------------------------------------------------------

//Redondear un número
Math.round(numero);

//--------------------------------------------------------

//Sacar código de carácter de una letra
let codeChar = e.charCode;

//--------------------------------------------------------

//Evento de pulsación de tecla
elemento.onkeypress;

//--------------------------------------------------------

//Crear una nueva opción para select sin usar document.createElement("option")
let nuevaOpcion = new Option(texto, valor); //El texto es lo que se muestra y el valor es el value del elemento
select.add(nuevaOpcion);

//--------------------------------------------------------

//Eliminar espacios en blanco
let text = "Hola Mundo";
text.trim(); //Imprime "HolaMundo"