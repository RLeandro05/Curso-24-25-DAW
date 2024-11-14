function BD() {
    //Crear una conexión para poder hacer una base de datos
    let jsStoreCon = new JsStore.Connection(new Worker("jsstore/jsstore.worker.min.js"));

    //Definir y crear la tabla de personas
    let tbPersonas = {
		name: 'personas', //Para indicar el nombre de la tabla
		columns: { //Para crear los campos que tendrá la tabla
				id: { primaryKey: true, autoIncrement: true },
				dni: { notNull: true, dataType: "string"},
				nombre: { notNull: true, dataType: "string"},
				apellidos: { notNull: false, dataType: "string"},
				fecNac: { notNull: true, dataType: "date_time"}, //date_time para añadir además de la fecha, también la hora
				estatura: { dataType: "number" },
		}
	};

	//Crear nombre de la base de datos y añadir tanto el nombre como las tablas en la misma
	let dbName ='Ejercicio1';
	let dataBase = {
		name: dbName,
		tables: [tbPersonas]
	}

	//Función para crear la base de datos
	const createDB = async (db)=>{
		try {
			const isDbCreated = await jsStoreCon.initDb(db);
			if(isDbCreated === true){
				console.log("db creada");
				
				insertarPersonas(); //Llamar a la función para insertar dos personas iniciales

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
	
	createDB(dataBase); //Crear la base de datos

	//Función para insertar dos primeras personas
	const insertarPersonas = async() => {
		console.log("Entra en insertarPersonas");
		
		let personas = [
			{
				dni: "12345678A",
				nombre: "Alfonso",
				apellidos: "Domínguez Martín",
				fecNac: new Date("1990-12-03"),
				estatura: 176
			},
			{
				dni: "12345678B",
				nombre: "Laura",
				apellidos: null,
				fecNac: new Date("1992-03-12"),
				estatura: 164
			}
		]

		let insertCount = await jsStoreCon.insert({ //Insertar la lista de las personas a la tabla correspondiente
			into: 'personas',
			values: personas
		});

		//Asegurar que se insertaron
		console.log("Insertadas: '"+insertCount+"' filas");
		
	}

	//Función para eliminar la base de datos
	/*const eliminarDB = async () => {
        try {
            await jsStoreCon.dropDb(dbName);
            console.log("Base de datos eliminada con éxito");
        } catch (ex) {
            console.log("Error al eliminar la base de datos:", ex);
        }
    };

    //Llamada a eliminarDB para probar
    eliminarDB();*/
}