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
        fecha: { notNull: true, dataType: "date_time" }
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
            fecha: new Date("2005-03-05")
        },
        {
            valor1: "valor1_SegundoObjeto",
            valor2: 2, //Al ser notNull:false, podemos dejarlo vacío si queremos
            fecha: new Date("2004-12-11")
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
            eliminarPersona(valor.id, valor.nombre, valor.apellidos);
        };
        celdaBtELIMINAR.appendChild(btELIMINAR);

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