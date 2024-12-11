//FETCH GET
fetch(url).then(function (datos) { // Promesa
    console.log("datos: ", datos);
    return datos.json(); // Parsear directamente a json
}).then(function (response) {
    console.log("response: ", response);
    cargarLista(response); // Enviar a la función de carga de datos la respuesta del servidor
});

//--------------------------------------------------------

//FETCH POST
let objeto = { // Objeto
    atributo1: valor1,
    atributo2: valor2,
    atributo3: valor3
}

let parametrosObjeto = { // Establecer parametros de POST y parse a JSON del objeto
    method: "POST",
    body: JSON.stringify(objeto)
}

fetch(url, parametrosObjeto).then(function (datos) { // Promesa
    console.log("datos: ", datos);
    return datos.json(); // Parsear directamente a json
}).then(function (response) {
    console.log("response: ", response);
    cargarLista(response); // Enviar a la función de carga de datos la respuesta del servidor
});

//--------------------------------------------------------

//AJAX
peticion.peticion(url, "POST", cargarLista, JSON.stringify(objeto)); // Definir objeto y en POST, enviar la petición. Luego, imprimir nuevamente

peticion.peticion(url, 'GET', cargarLista); // No hay objeto al ser un GET. Luego, imprimir nuevamente la lista

peticion = new pAJAX(); // En window.onload, crear el objeto del utilAjax.js

//--------------------------------------------------------

//CONFIRM
if (confirm("Mensaje de confirmación")) { // Mensaje de confirmación a la hora de realizar operaciones delicadas
    // Acción 1
} else {
    // Acción 2
}

//--------------------------------------------------------

//ASPECTOS IMPORTANTES
/*
1. Recordar siempre tener en cuenta el response para poder imprimir por pantalla los datos
2. Console.log siempre para asegurar de que todo va en orden paso a paso
3. A la hora de imprimir la tabla, si pide poner botones, en la creación de celdas, añadirlos ahí y colocar .onlick anónimo por cada creación
4. Tener en cuenta si el atributo de un objeto está en mayúscula, minúscula o mix
5. Código siempre ordenado y comentarios clave 
6. En caso de llamar a una función en función anónima o función no anónima, llamarla con paréntesis
7. En caso de llamar a una función en window.onload, no poner los paréntesis
8. Uso importante de querySelector al ser más rápido y corto
9. Actualizar siempre los datos en cuanto se realice una operación (Añadir, Borrar, Editar, etc...)
*/