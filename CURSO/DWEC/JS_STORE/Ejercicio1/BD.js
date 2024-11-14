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
}