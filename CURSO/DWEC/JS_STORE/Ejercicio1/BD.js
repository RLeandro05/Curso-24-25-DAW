let jsStoreCon;

function BD() {
	//Crear una conexión para poder hacer una base de datos
	jsStoreCon = new JsStore.Connection(new Worker("jsstore/jsstore.worker.min.js"));

	//Definir y crear la tabla de personas
	let tbPersonas = {
		name: 'personas', //Para indicar el nombre de la tabla
		columns: { //Para crear los campos que tendrá la tabla
			id: { primaryKey: true, autoIncrement: true },
			dni: { notNull: true, dataType: "string" },
			nombre: { notNull: true, dataType: "string" },
			apellidos: { notNull: false, dataType: "string" },
			fecNac: { notNull: true, dataType: "date_time" }, //date_time para añadir además de la fecha, también la hora
			estatura: { dataType: "number" },
		}
	};

	//Crear nombre de la base de datos y añadir tanto el nombre como las tablas en la misma
	let dbName = 'Ejercicio1';
	let dataBase = {
		name: dbName,
		tables: [tbPersonas]
	}

	//Función para crear la base de datos
	const createDB = async (db) => {
		try {
			const isDbCreated = await jsStoreCon.initDb(db);
			if (isDbCreated === true) {
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
	const insertarPersonas = async () => {
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
		console.log("Insertadas: '" + insertCount + "' filas");

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

	//Función para mostrar de la base de datos, la tabla entera
	const mostrarPersonas = async () => {
		let personas = await jsStoreCon.select({ //Realizar consulta de select *
			from: "personas"
		});

		//Limpiar la tabla antes de agregar las filas nuevas
		let cuerpoTabla = document.querySelector("#personasTable tbody");
		cuerpoTabla.innerHTML = ""; // Limpiar tabla actual

		//Recorrer y mostrar cada persona en la tabla
		personas.forEach(persona => {
			let fila = cuerpoTabla.insertRow();

			//Crear las celdas para cada columna
			let celdaDNI = fila.insertCell();
			celdaDNI.textContent = persona.dni;

			let celdaNOMBRE = fila.insertCell();
			celdaNOMBRE.textContent = persona.nombre;

			let celdaAPELLIDOS = fila.insertCell();
			celdaAPELLIDOS.textContent = persona.apellidos;

			let celdaFECNA = fila.insertCell();
			celdaFECNA.textContent = new Date(persona.fecNac).toLocaleDateString(); //Usar toLocaleDateString para poner sólo el string

			let celdaESTATURA = fila.insertCell();
			celdaESTATURA.textContent = persona.estatura;

			//Crear la celda para el botón de eliminar
			let celdaBtELIMINAR = fila.insertCell();
			let btELIMINAR = document.createElement("button");
			btELIMINAR.textContent = "Eliminar";
			btELIMINAR.onclick = function () { //En caso de pinchar en él, llamar a la función
				eliminarPersona(persona.id, persona.nombre, persona.apellidos);
			};
			celdaBtELIMINAR.appendChild(btELIMINAR);
		});
	};

	mostrarPersonas();

	//Función para eliminar una persona específica
	const eliminarPersona = async (id, nombre, apellidos) => {
		console.log("Llega a eliminarPersona");

		//Verificar si 'apellidos' es null para evitar problemas al construir el mensaje
		const nombreCompleto = apellidos ? `${nombre} ${apellidos}` : nombre;

		if (confirm(`¿Estás seguro de que deseas eliminar a '${nombreCompleto}'?`)) {
			try {
				await jsStoreCon.remove({ //Realizar la consulta para eliminar dicha persona
					from: "personas",
					where: {
						id: id
					}
				});

				alert(`Se eliminó a '${nombreCompleto}'`);
				mostrarPersonas(); //Mostrar nuevamente la lista para asegurar que la persona fue eliminada correctamente
			} catch (error) {
				console.error(`Error al eliminar a '${nombreCompleto}':`, error);
			}
		}
	}
}