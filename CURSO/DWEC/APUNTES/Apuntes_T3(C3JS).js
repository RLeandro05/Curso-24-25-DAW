//Crear un gráfico
let chart = c3.generate({
    bindto: "#grafico",
    data: {
        columns: datos,
        type: "bar"
    }
})

//--------------------------------------------------------

//Descargar un archivo JSON
const descargarDatos = (archivoJSON) => {
    let link = document.createElement("a");
    const nombreFichero = prompt("Introduce el nombre del fichero (no pongas extensión)", "Datos_EPA");

    link.download = nombreFichero + ".json";

    let blob = new Blob([archivoJSON], { type: "application/json" });

    link.href = URL.createObjectURL(blob);
    link.click();

    URL.revokeObjectURL(link.href);
}

JSON.stringify(archivoJSON);
descargarDatos(archivoJSON);

//--------------------------------------------------------

//Leer un fichero XML
function Leer_Fichero(evento) {
    let e = evento || window.event; //Guardar en una variabel el evento accionado
    let fichero = e.target.files[0]; //Guardar el fichero en una variable

    function Convertir_a_XML(texto) { //Función para convertir a xml
        if (window.ActiveXObject) {
            xml = new ActiveXObject("Microsoft.XMLDOM");
            xml.loadXML(texto);
        } else {
            xml = new DOMParser().parseFromString(texto, "text/xml");
            return xml;
        }
    }

    let reader = new FileReader(); //Instanciar un reader

    reader.onload = function (e) { //Cuando se cargue el fichero, convertir a xml y devolver resultado
        let miXml = Convertir_a_XML(reader.result);
        xml = miXml;
        //console.log("miXml: ", miXml);
        tratarXML(miXml);
    }
    reader.readAsText(fichero); //Leer el fichero como texto
}

//--------------------------------------------------------

//Guardar en un HTMLCollection elementos hijos de un elemento xml y mostrar su tagName
let children = elemento.children;

children[i].tagName;

//--------------------------------------------------------

//Configurar ejes x e y en un gráfico
chart = c3.generate({
    bindto: div,
    data: {
        columns: [
            datosGrafico
        ],
    },
    axis: {
        //Configurar eje x
        x: {
            type: "category",
            categories: ejeX, //Añadir en el eje x la lista de los valores de los trimestres
            tick: {
                rotate: 30 //Rotar 30º para dejar algo de estética
            }
        },
        y: {
            type: "category",
            categories: ejeY, //Añadir en el eje x la lista de los valores de los trimestres
            tick: {
                rotate: -30 //Rotar -30º para dejar algo de estética
            }
        }
    }
});

//--------------------------------------------------------

//Leer un archivo JSON
const LeerJSON = () => {
    // Obtener el archivo seleccionado por el usuario
    const fichero = document.querySelector("#fichero").files[0];

    if (fichero) {
        const reader = new FileReader();

        // Evento que se ejecuta cuando se ha leído el archivo correctamente
        reader.onload = (event) => {
            try {
                // Parsear el contenido del archivo JSON
                const datos = JSON.parse(event.target.result);

                // Hacer algo con los datos (por ejemplo, mostrar el contenido en el select)
                mostrarDatosEnSelect(datos);
                // Aquí podrías agregar más lógica para generar gráficos o procesar la información
            } catch (error) {
                console.error("Error al leer el JSON:", error);
            }
        };

        // Leer el archivo como texto
        reader.readAsText(fichero);
    }
};

//--------------------------------------------------------

//Agrupar objetos de un json a partir de ciertos elementos del mismo
listaSexos = Object.groupBy(archivoJSON, sexo => sexo.MetaData[1].Nombre);

//--------------------------------------------------------

//Mostrar las keys asociadas a las agrupaciones de Object.groupBy
for (const key in listaSexos) {
    console.log(key);
}