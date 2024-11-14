//  Javascript para la creación, acceso y manipulacion de BD local:

function BD() {

	/*
  //  Damos tamaño de 200 MB ==>  200 * 1024*1024
  this.db = window.openDatabase("bulder", "1.0", "Bulder BD", (100 * 1024 * 1024));
  if ((!localStorage.instalada) || (localStorage.instalada == undefined) || (localStorage.instalada != "SI")) {
    this.db.transaction(creaTablas, error, success);
  }
	*/
	
	//  Usamos JsStore:
	var jsStoreCon = new JsStore.Connection(new Worker("jsstore/jsstore.worker.min.js"));
	
	//  Definimos las tablas:
	var tblProvincias = {
		name: 'provincias',
		columns: {
				// Here "Id" is name of column 
				id: { primaryKey: true, autoIncrement: true },
				id_provincia: { notNull: true, dataType: "number" },
				provincia:  { notNull: false, dataType: "string" }
		}
	};
	
	

	/*
	name: {
			notNull: true,
			dataType: 'string'
	},
	gender: {
			dataType: 'string',
			default: 'male'
	},
	*/

	var tblLugares = {
		name: 'lugares',
		columns: {
				// Here "Id" is name of column 
				id:{ primaryKey: true, autoIncrement: true },
				provincia:  { notNull: false, dataType: "string" },
				pais: { notNull: false, dataType: "number" },
				cprovincia: { notNull: false, dataType: "number" },
				cmunicipio: { notNull: false, dataType: "number" },
				direccion:  { notNull: false, dataType: "string" },
				latitud: { notNull: false, dataType: "number" },
				longitud: { notNull: false, dataType: "number" }
		}
	};

	var tblImagenes = {
		name: 'imagenes',
		columns: {
				// Here "Id" is name of column 
				id:{ primaryKey: true, autoIncrement: true },
				id_servidor: { notNull: false, dataType: "number" },
				id_usuario: { notNull: false, dataType: "number" },
				id_lugar: { notNull: false, dataType: "number" },

				fecha: { notNull: false, dataType: "date_time" },
				imagen_min: { notNull: false, dataType: "object" },
				imagen: { notNull: false, dataType: "object" }
		}
	};

	var tblGrados = {
		name: 'grados',
		columns: {
				id:{ primaryKey: true, autoIncrement: true },
				nombre: { notNull: false, dataType: "string" },
				equivalencia:  { notNull: false, dataType: "string" },
				valor: { notNull: true, dataType: "number" }
		}
	};
	
	

	var tblBulders = {
		name: 'bulders',
		columns: {
				// Here "Id" is name of column 
				id:{ primaryKey: true, autoIncrement: true },
				id_usuario: { notNull: true, dataType: "number" },
				id_imagen: { notNull: true, dataType: "number" },
				id_grado: { notNull: true, dataType: "number" },
				fecha: { notNull: true, dataType: "date_time" },

				bulderwidth: { notNull: true, dataType: "number" },
				bulderheight: { notNull: true, dataType: "number" },

				comentario: { notNull: false, dataType: "string" },
				bulder: { notNull: false, dataType: "string" }
		}
	};

	var dbName ='prueba1';
	var database = {
		name: dbName,
		tables: [tblProvincias, tblLugares, tblImagenes, tblGrados, tblBulders]
	}


	const createDB = async (db)=>{
		try {
			const isDbCreated = await jsStoreCon.initDb(db);
			if(isDbCreated === true){
				console.log("db created");
				// here you can prefill database with some data
				insertarGrados();
				insertarProvincias();
				 //  console.log("Tablas iniciales creadas con éxito!");
			}
			else {
				console.log("db opened");
			}
		}
		catch (ex) {
			console.log(ex);
			console.log(ex.message);
			alert(ex.message);
		}
	}
	
	createDB(database);



	const insertarGrados = async ()=>{

		console.log("Vamos a insertar los grados en la tabla grados");

		let valores = [
			{
				nombre: '4',
				equivalencia: 'IV',
				valor: 1
			},
			{
				nombre: '4+',
				equivalencia: 'IV+',
				valor: 2
			},
			{
				nombre: '5',
				equivalencia: 'V',
				valor: 3
			},
			{
				nombre: '5+',
				equivalencia: 'V+',
				valor: 4
			},
			{
				nombre: '6a',
				equivalencia: '6a',
				valor: 5
			},
			{
				nombre: '6a+',
				equivalencia: '6a+',
				valor: 6
			},
			{
				nombre: '6b',
				equivalencia: '6b',
				valor: 7
			},
			{
				nombre: '6b+',
				equivalencia: '6b+',
				valor: 8
			},
			{
				nombre: '6c',
				equivalencia: '6c',
				valor: 9
			},
			{
				nombre: '6c+',
				equivalencia: '6c+',
				valor: 10
			},
			{
				nombre: '7a',
				equivalencia: '7a',
				valor: 11
			},
			{
				nombre: '7a+',
				equivalencia: '7a+',
				valor: 12
			},
			{
				nombre: '7b',
				equivalencia: '7b',
				valor: 13
			},
			{
				nombre: '7b+',
				equivalencia: '7b+',
				valor: 14
			},
			{
				nombre: '7c',
				equivalencia: '7c',
				valor: 15
			},
			{
				nombre: '7c+',
				equivalencia: '7c+',
				valor: 16
			},
			{
				nombre: '8a',
				equivalencia: '8a',
				valor: 17
			},
			{
				nombre: '8a+',
				equivalencia: '8a+',
				valor: 18
			},
			{
				nombre: '8b',
				equivalencia: '8b',
				valor: 19
			},
			{
				nombre: '8b+',
				equivalencia: '8b+',
				valor: 20
			},
			{
				nombre: '8c',
				equivalencia: '8c',
				valor: 21
			},
			{
				nombre: '8c+',
				equivalencia: '8c+',
				valor: 22
			},
			{
				nombre: '9a',
				equivalencia: '9a',
				valor: 23
			},
			{
				nombre: '9a+',
				equivalencia: '9a+',
				valor: 24
			},
			{
				nombre: '9b',
				equivalencia: '9b',
				valor: 25
			},
			{
				nombre: '9b+',
				equivalencia: '9b+',
				valor: 26
			},
			{
				nombre: '9c',
				equivalencia: '9c',
				valor: 27
			},
			{
				nombre: '9c+',
				equivalencia: '9c+',
				valor: 10
			}
		];

		let insertCount = await jsStoreCon.insert({
			into: 'grados',
			values: valores
		});
		console.log(`${insertCount} rows inserted (grados)`);
	}  //  insertarGrados


		
	const insertarProvincias = async ()=>{
		console.log("Vamos a insertar los grados en la tabla provincias");
		let valores = [
			{id_provincia: 2, provincia: 'Albacete'},
			{id_provincia: 3, provincia: 'Alicante/Alacant'},
			{id_provincia: 4, provincia: 'Almería'},
			{id_provincia: 1, provincia: 'Araba/Álava'},
			{id_provincia: 33, provincia: 'Asturias'},
			{id_provincia: 5, provincia: 'Ávila'},
			{id_provincia: 6, provincia: 'Badajoz'},
			{id_provincia: 7, provincia: 'Balears, Illes'},
			{id_provincia: 8, provincia: 'Barcelona'},
			{id_provincia: 48, provincia: 'Bizkaia'},
			{id_provincia: 9, provincia: 'Burgos'},
			{id_provincia: 10, provincia: 'Cáceres'},
			{id_provincia: 11, provincia: 'Cádiz'},
			{id_provincia: 39, provincia: 'Cantabria'},
			{id_provincia: 12, provincia: 'Castellón/Castelló'},
			{id_provincia: 13, provincia: 'Ciudad Real'},
			{id_provincia: 14, provincia: 'Córdoba'},
			{id_provincia: 15, provincia: 'Coruña, A'},
			{id_provincia: 16, provincia: 'Cuenca'},
			{id_provincia: 20, provincia: 'Gipuzkoa'},
			{id_provincia: 17, provincia: 'Girona'},
			{id_provincia: 18, provincia: 'Granada'},
			{id_provincia: 19, provincia: 'Guadalajara'},
			{id_provincia: 21, provincia: 'Huelva'},
			{id_provincia: 22, provincia: 'Huesca'},
			{id_provincia: 23, provincia: 'Jaén'},
			{id_provincia: 24, provincia: 'León'},
			{id_provincia: 25, provincia: 'Lleida'},
			{id_provincia: 27, provincia: 'Lugo'},
			{id_provincia: 28, provincia: 'Madrid'},
			{id_provincia: 29, provincia: 'Málaga'},
			{id_provincia: 30, provincia: 'Murcia'},
			{id_provincia: 31, provincia: 'Navarra'},
			{id_provincia: 32, provincia: 'Ourense'},
			{id_provincia: 34, provincia: 'Palencia'},
			{id_provincia: 35, provincia: 'Palmas, Las'},
			{id_provincia: 36, provincia: 'Pontevedra'},
			{id_provincia: 26, provincia: 'Rioja, La'},
			{id_provincia: 37, provincia: 'Salamanca'}, 
			{id_provincia: 38, provincia: 'Santa Cruz de Tenerife'},
			{id_provincia: 40, provincia: 'Segovia'},
			{id_provincia: 41, provincia: 'Sevilla'},
			{id_provincia: 42, provincia: 'Soria'},
			{id_provincia: 43, provincia: 'Tarragona'}, 
			{id_provincia: 44, provincia: 'Teruel'},
			{id_provincia: 45, provincia: 'Toledo'}, 
			{id_provincia: 46, provincia: 'Valencia/Valéncia'},
			{id_provincia: 47, provincia: 'Valladolid'},
			{id_provincia: 49, provincia: 'Zamora'},
			{id_provincia: 50, provincia: 'Zaragoza'}, 
			{id_provincia: 51, provincia: 'Ceuta'}, 
			{id_provincia: 52, provincia: 'Melilla'}
		];

		let insertCount = await jsStoreCon.insert({
			into: 'provincias',
			values: valores
		});
		console.log(`${insertCount} rows inserted (grados)`);
	}  //  insertarProvincias


} //  DB



