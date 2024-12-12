//Llamar a un archivo js externo
//<script src="archivo.js"></script>

//--------------------------------------------------------

//Usar jsstore
//<script src="jsstore/jsstore.min.js"></script>
//<script src="jsstore/jsstore.worker.min.js"></script>

//--------------------------------------------------------

//Crear una nueva conexión
let jsStoreCon = new JsStore.Connection(new Worker("jsstore/jsstore.worker.min.js")); //Ruta donde se encuentre el archivo

//--------------------------------------------------------

//Crear una nueva tabla
let tabla = {
    name: "tablaPrueba",
    columns: {
        id: { primaryKey: true, autoIncrement: true },
        valor1: { notNull: true, dataType: "string" },
        valor2: { notNull: false, dataType: "number" },
        fecha: { notNull: true, dataType: "date_time" },
        imagen64: { notNull: false, dataType: "string" }
    }
}

//--------------------------------------------------------

//Crear una base de datos

let dataBase = {
    name: "BBDD_Prueba",
    tables: [tabla]
}

//--------------------------------------------------------

//Función para crear la base de datos instanciada
const createDB = async (dataBase) => {
    try {
        const isDbCreated = await jsStoreCon.initDb(dataBase);
        if (isDbCreated === true) {
            console.log("db creada");

            insertarValoresInic(); //Llamar a la función para insertar dos personas iniciales

            console.log("Tablas iniciales creadas con éxito!");
        }
        else {
            console.log("db abierto");
        }
    }
    catch (ex) {
        console.log(ex);
        console.log(ex.message);
        alert(ex.message);
    }
}

createDB(dataBase); //Llamar a la función

//--------------------------------------------------------

//Función para insertar valores al inicio de la creación de una base de datos
const insertarValoresInic = async () => {
    console.log("Entra en insertarValoresInic");

    let valores = [
        {
            valor1: "valor1_PrimerObjeto",
            valor2: 1, //Al ser notNull:false, podemos dejarlo vacío si queremos
            fecha: new Date("2005-03-05"),
            imagen64: null
        },
        {
            valor1: "valor1_SegundoObjeto",
            valor2: 2, //Al ser notNull:false, podemos dejarlo vacío si queremos
            fecha: new Date("2004-12-11"),
            imagen64: null
        }
    ]

    let insertCount = await jsStoreCon.insert({ //Insertar la lista de los valores a la tabla correspondiente
        into: 'tablaPrueba',
        values: valores
    });

    //Asegurar que se insertaron
    console.log("Insertadas: '" + insertCount + "' filas");

}

//--------------------------------------------------------

//Función para mostrar los datos de la tabla en pantalla
const mostrarValores = async () => {
    let valores = await jsStoreCon.select({ //Realizar consulta de select *
        from: "tablaPrueba"
    });

    //Limpiar la tabla antes de agregar las filas nuevas
    let cuerpoTabla = document.querySelector("table tbody");
    cuerpoTabla.innerHTML = ""; // Limpiar tabla actual

    //Recorrer y mostrar cada persona en la tabla
    valores.forEach(valor => {
        let fila = cuerpoTabla.insertRow();

        //Crear las celdas para cada columna
        let celdaValor1 = fila.insertCell();
        celdaValor1.textContent = valor.valor1;

        let celdaVALOR2 = fila.insertCell();
        celdaVALOR2.textContent = valor.valor2;

        let celdaFECNA = fila.insertCell();
        celdaFECNA.textContent = new Date(valor.fecha).toLocaleDateString(); //Usar toLocaleDateString para poner sólo el string

        let celdaBtELIMINAR = fila.insertCell();
        let btELIMINAR = document.createElement("button");
        btELIMINAR.id = "btEliminar";
        btELIMINAR.textContent = "Eliminar";
        btELIMINAR.onclick = function () { //En caso de pinchar en él, llamar a la función
            eliminarValor(valor.id, valor.nombre, valor.apellidos);
        };
        celdaBtELIMINAR.appendChild(btELIMINAR);

        let celdaIMAGEN64 = fila.insertCell();
        if (persona.imagen64) { //En el caso de que exista una imagen asociada, mostrarla
            //Dar los atributos necesarios a la imagen creada
            let img = document.createElement("img");
            img.src = persona.imagen64;
            img.style.width = "100px";
            celdaIMAGEN64.appendChild(img);
        } else { //Si no existe la imagen, mostrar un mensaje que indique no hay imagen asociada a la persona
            celdaIMAGEN64.textContent = "No hay imagen";
        }

        let celdaBtMODIFICAR = fila.insertCell();
        let btMODIFICAR = document.createElement("button");
        btMODIFICAR.textContent = "Editar";
        btMODIFICAR.id = "btModificar";
        btMODIFICAR.onclick = function () { //En caso de pinchar en él, llamar a la función
            //En el caso de editar, cambiar el título y el botón
            document.querySelector("legend").innerHTML = "Modificar persona";
            document.querySelector("#btAniadir").innerHTML = "Aplicar";
            modificarPersona(valor);
        };
        celdaBtMODIFICAR.appendChild(btMODIFICAR);
    });
};

mostrarValores();

//--------------------------------------------------------

//Función para eliminar una persona específica
const eliminarValor = async (id, valor1, valor2) => {
    console.log("Llega a eliminarPersona");

    if (confirm(`¿Estás seguro de que deseas eliminar a '${valorCompleto}'?`)) {
        try {
            await jsStoreCon.remove({ //Realizar la consulta para eliminar dicho valor
                from: "tablaPrueba",
                where: {
                    id: id
                }
            });

            alert(`Se eliminó a '${valorCompleto}'`);
            mostrarValores(); //Mostrar nuevamente la lista para asegurar que el valor fue eliminado correctamente
        } catch (error) {
            console.error(`Error al eliminar a '${valorCompleto}':`, error);
        }
    }
}

//--------------------------------------------------------

//Función para modificar la información de un valor específico
const modificarPersona = async (valor) => {
    console.log("Llega a modificarPersona");

    let id = valor.id;

    let valor1 = document.querySelector("#valor1").value = valor.valor1;
    let valor2 = document.querySelector("#valor2").value = valor.valor2;
    let fecha = document.querySelector("#fecha").value = valor.fecha.toLocaleDateString('en-CA');

    console.log(valor1, valor2, fecha);

    document.querySelector("#btAniadir").onclick = async () => { //Una vez pulsado en aplicar los cambios, entrar a la función
        //Guardar los nuevos valores en las variables
        valor1 = document.querySelector("#valor1").value;
        valor2 = document.querySelector("#valor2").value;
        fecha = document.querySelector("#fecha").value;

        let img = document.querySelector("#imagen").files[0]; //Guardar la imagen del formulario en una variable

        if (img) { //Si esa imagen existe, es decir, que se ha escogido alguna imagen, llamar a leerImagen, pasándole la persona. No podrá seguir adelante hasta terminar la función
            await leerImagen(valor);
        }

        //Crear a la persona modificada
        const valorModificado = {
            valor1: valor1,
            valor2: valor2,
            fecha: new Date(fecha),
            imagen64: valor.imagen64
        }

        try {
            //Realizar la consulta para actualizar la persona en la base de datos
            await jsStoreCon.update({
                in: "tablaPrueba",
                set: valorModificado,
                where: {
                    id: id
                }
            });

            //Mostrar la lista de personas para asegurar que la actualización fue exitosa
            mostrarValores();

        } catch (error) {
            console.error("Hubo un error al modificar el valor", error);
        }
    }
}

//--------------------------------------------------------

//Función para añadir un nuevo valor
const aniadirValor = async () => {
    console.log("Llega a aniadirValor");

    //Entrar al bloque al pinchar en Añadir
    document.querySelector("#btAniadir").onclick = async () => {
        //Guardar en variables los valores del formulario
        let valor1 = document.querySelector("#valor1").value;
        let valor2 = document.querySelector("#valor2").value;
        let fecha = document.querySelector("#fecha").value;

        let img = document.querySelector("#imagen").files[0]; //Guardar la imagen del formulario en una variable

        console.log(valor1, valor2, fecha, img);

        let valor = { //Crear un objeto valor que guarde un atributo imagen64 para poder darle valor al final
            imagen64: null
        }

        if (img) { //Si esa imagen existe, es decir, que se ha escogido alguna imagen, llamar a leerImagen, pasándole el valor. No podrá seguir adelante hasta terminar la función
            await leerImagen(valor); //Leer la imagen y asignarla a valor.imagen64
        }

        if (!valor1 || !valor2 || !fecha) { //Si algunos de los campos excepto apellidos está nulo, mostrará mensaje de error
            alert("Algunos de los campos obligatorios están vacíos.");
        } else {
            try {
                //Crear una nueva persona
                const nuevoValor = {
                    valor1: valor1,
                    valor2: valor2,
                    fecha: new Date(fecha),
                    imagen64: valor.imagen64
                }

                //Realizar la consulta de inserción
                await jsStoreCon.insert({
                    into: "tablaPrueba",
                    values: [nuevoValor]
                })

                console.log("Persona añadida correctamente");

                BD(); //Volver a mostrar la lista para asegurarse de que está añadida a la tabla

            } catch (error) {
                console.error("Hubo un error al añadir el nuevo valor", error);
            }
        }

    }
}

//--------------------------------------------------------

//Función para leer imágenes
const leerImagen = async (valor) => {
    console.log("Entra en leerImagen");

    //Guardar la imagen en la variable
    let img = document.querySelector("#imagen").files[0];

    //Crear un nuevo reader
    let reader = new FileReader();

    return new Promise((resolve, reject) => { //Crear una nueva promesa
        if (img) { //Si existe la imagen, entrar
            reader.onloadend = () => { //Una vez se lea entero, entrar
                valor.imagen64 = reader.result; //Guardar el resultado leído en persona.imagen64
                resolve(); //Al existir la imagen, podemos dar por concluida la ejecución de la promesa, devolviendo un resolve como prueba de éxito
            };
            reader.onerror = reject; //Si ocurre un error, lo rechazamos
            reader.readAsDataURL(img); //Leer el archivo al final
        } else { //Si no existe ninguna imagen seleccionada o sin seleccionar, directamente rechazar la promesa
            reject("No hay archivo de imagen seleccionado");
        }
    });
}

//--------------------------------------------------------

//Función para eliminar la base de datos
const eliminarDB = async () => {
    try {
        await jsStoreCon.dropDb(dataBase);
        console.log("Base de datos eliminada con éxito");
    } catch (ex) {
        console.log("Error al eliminar la base de datos:", ex);
    }
};

//--------------------------------------------------------

/*Se debe tener en cuenta de que la función para añadir un nuevo valor
estará fuera de la función, ya que no se ejecutará a menos de que el usuario
ejecute algún evento para ello, además de la función para leer la imagen64.
Además, las funciones que siempre se deben ejecutar dentro sería la de mostrar los datos, eliminar y modificar,
ya que, al crear botones que te llevan a dichas funciones, interesa tenerlas dentro, porque no se
ejecutarán a menos que el usuario realice el evento*/