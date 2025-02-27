let jsStoreCon;
const dbName = 'Ejercicio1';

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
			imagenBlob: { notNull: false, dataType: "object" },
			imagen64: { notNull: false, dataType: "string" }
		}
	};

	//Crear nombre de la base de datos y añadir tanto el nombre como las tablas en la misma
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
				estatura: 176,
				imagenBlob: null,
				imagen64: null
			},
			{
				dni: "12345678B",
				nombre: "Laura",
				apellidos: null,
				fecNac: new Date("1992-03-12"),
				estatura: 164,
				imagenBlob: null,
				imagen64: null
			}
		]

		let insertCount = await jsStoreCon.insert({ //Insertar la lista de las personas a la tabla correspondiente
			into: 'personas',
			values: personas
		});

		//Asegurar que se insertaron
		console.log("Insertadas: '" + insertCount + "' filas");

	}

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

			let celdaIMAGENBLOB = fila.insertCell();
			celdaIMAGENBLOB.textContent = persona.imagenBlob;

			let celdaIMAGEN64 = fila.insertCell();
			if(persona.imagen64) { //En el caso de que exista una imagen asociada, mostrarla
				//Dar los atributos necesarios a la imagen creada
				let img = document.createElement("img");
				img.src = persona.imagen64;
				img.style.width = "100px";
				celdaIMAGEN64.appendChild(img);
			} else { //Si no existe la imagen, mostrar un mensaje que indique no hay imagen asociada a la persona
				celdaIMAGEN64.textContent = "No hay imagen";
			}

			let celdaBtELIMINAR = fila.insertCell();
			let btELIMINAR = document.createElement("button");
			btELIMINAR.id = "btEliminar";
			btELIMINAR.textContent = "Eliminar";
			btELIMINAR.onclick = function () { //En caso de pinchar en él, llamar a la función
				eliminarPersona(persona.id, persona.nombre, persona.apellidos);
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
				modificarPersona(persona);
			};
			celdaBtMODIFICAR.appendChild(btMODIFICAR);
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

	//Función para modificar la información de una persona específica
	const modificarPersona = async (persona) => {
		console.log("Llega a modificarPersona");

		let id = persona.id;

		let dni = document.querySelector("#dni").value = persona.dni;
		let nombre = document.querySelector("#nombre").value = persona.nombre;
		let apellidos = document.querySelector("#apellidos").value = persona.apellidos;
		let fecna = document.querySelector("#fecna").value = persona.fecNac.toLocaleDateString('en-CA');
		let estatura = document.querySelector("#estatura").value = persona.estatura;

		console.log(dni, nombre, apellidos, fecna, estatura);


		mostrarFormulario(); //Mostrar formulario

		document.querySelector("#btAniadir").onclick = async () => { //Una vez pulsado en aplicar los cambios, entrar a la función
			//Guardar los nuevos valores en las variables
			dni = document.querySelector("#dni").value;
			nombre = document.querySelector("#nombre").value;
			apellidos = document.querySelector("#apellidos").value;
			fecna = document.querySelector("#fecna").value;
			estatura = parseInt(document.querySelector("#estatura").value);

			let img = document.querySelector("#imagen").files[0]; //Guardar la imagen del formulario en una variable

			if (img) { //Si esa imagen existe, es decir, que se ha escogido alguna imagen, llamar a leerImagen, pasándole la persona. No podrá seguir adelante hasta terminar la función
				await leerImagen(persona);
			}

			//Crear a la persona modificada
			const personaModificada = {
				dni: dni,
				nombre: nombre,
				apellidos: apellidos,
				fecNac: new Date(fecna),
				estatura: estatura,
				imagenBlob: null,
				imagen64: persona.imagen64
			}

			try {
				//Realizar la consulta para actualizar la persona en la base de datos
				await jsStoreCon.update({
					in: "personas",
					set: personaModificada,
					where: {
						id: id
					}
				});

				//Mostrar la lista de personas para asegurar que la actualización fue exitosa
				mostrarPersonas();

				desaparecerFormulario(); //Desaparecer el formulario

			} catch (error) {
				console.error("Hubo un error al modificar la persona", error);
			}
		}
	}
}

//Función para añadir una nueva persona
const aniadirPersona = async () => {
	console.log("Llega a aniadirPersona");

	mostrarFormulario(); //Mostrar formulario

	//Entrar al bloque al pinchar en Añadir
	document.querySelector("#btAniadir").onclick = async () => {
		//Guardar en variables los valores del formulario
		let dni = document.querySelector("#dni").value;
		let nombre = document.querySelector("#nombre").value;
		let apellidos = document.querySelector("#apellidos").value;
		let fecna = document.querySelector("#fecna").value;
		let estatura = parseInt(document.querySelector("#estatura").value);

		let img = document.querySelector("#imagen").files[0]; //Guardar la imagen del formulario en una variable

		console.log(dni, nombre, apellidos, fecna, estatura, img);

		let persona = { //Crear un objeto persona que guarde un atributo imagen64 para poder darle valor al final
			imagen64: null
		}

		if (img) { //Si esa imagen existe, es decir, que se ha escogido alguna imagen, llamar a leerImagen, pasándole la persona. No podrá seguir adelante hasta terminar la función
            await leerImagen(persona); //Leer la imagen y asignarla a persona.imagen64
        }

		if (!dni || !nombre || !fecna || !estatura) { //Si algunos de los campos excepto apellidos está nulo, mostrra mensaje de error
			alert("Algunos de los campos (excepto 'APELLIDOS') está vacío.");
		} else {
			try {
				//Crear una nueva persona
				const nuevaPersona = {
					dni: dni,
					nombre: nombre,
					apellidos: apellidos,
					fecNac: new Date(fecna),
					estatura: estatura,
					imagenBlob: null,
					imagen64: persona.imagen64
				}

				//Realizar la consulta de inserción
				await jsStoreCon.insert({
					into: "personas",
					values: [nuevaPersona]
				})

				console.log("Persona añadida correctamente");

				BD(); //Volver a mostrar la lista para asegurarse de que está añadida a la tabla

				desaparecerFormulario(); //Desaparecer formulario

			} catch (error) {
				console.error("Hubo un error al añadir a la nueva persona", error);
			}
		}

	}
}

//Función para leer imágenes
const leerImagen = async (persona) => {
	console.log("Entra en leerImagen");

	//Guardar la imagen en la variable
	let img = document.querySelector("#imagen").files[0];

	//Crear un nuevo reader
	let reader = new FileReader();

	return new Promise((resolve, reject) => { //Crear una nueva promesa
        if (img) { //Si existe la imagen, entrar
            reader.onloadend = () => { //Una vez se lea entero, entrar
                persona.imagen64 = reader.result; //Guardar el resultado leído en persona.imagen64
                resolve(); //Al existir la imagen, podemos dar por concluida la ejecución de la promesa, devolviendo un resolve como prueba de éxito
            };
            reader.onerror = reject; //Si ocurre un error, lo rechazamos
            reader.readAsDataURL(img); //Leer el archivo al final
        } else { //Si no existe ninguna imagen seleccionada o sin seleccionar, directamente rechazar la promesa
            reject("No hay archivo de imagen seleccionado");
        }
    });
}

//Función para mostrar el formulario
const mostrarFormulario = async () => {
    const formulario = document.querySelector("#formPersonas");

    formulario.style.display = "block";
}


//Función para quitar el formulario
const desaparecerFormulario = async () => {
	document.querySelector("#formPersonas").style.display = "none";

	//Vaciar los contenidos
	document.querySelector("#dni").value = "";
	document.querySelector("#nombre").value = "";
	document.querySelector("#apellidos").value = "";
	document.querySelector("#fecna").value = "";
	document.querySelector("#estatura").value = "";
}

//Función para eliminar la base de datos
const eliminarDB = async () => {
	try {
		await jsStoreCon.dropDb(dbName);
		console.log("Base de datos eliminada con éxito");
	} catch (ex) {
		console.log("Error al eliminar la base de datos:", ex);
	}
};