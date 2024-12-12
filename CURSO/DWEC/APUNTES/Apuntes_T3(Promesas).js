//Crear una nueva promesa
new Promise((resolve, reject) => {

});

//--------------------------------------------------------

//Aplicar uso de resolve y reject
const n1 = 1;
const n2 = 1;

return new Promise((resolve, reject) => {
    if (n1 + n2 == 2) {
        resolve("Es correcto");
    } else {
        reject("No es correcto");
    }
});

//--------------------------------------------------------

//Poder ejecutar varias funciones al mismo tiempo
function primeraFuncion() {
    return new Promise((resolve, reject) => {
        console.log("Primera función");
        resolve();  // Resuelve la promesa para continuar
    });
}

function segundaFuncion() {
    return new Promise((resolve, reject) => {
        console.log("Segunda función");
        resolve();  // Resuelve la promesa para continuar
    });
}

function terceraFuncion() {
    return new Promise((resolve, reject) => {
        console.log("Tercera función");
        resolve();  // Resuelve la promesa para continuar
    });
}

primeraFuncion()
    .then(() =>{
        segundaFuncion();
    })
    .then(() =>{
        terceraFuncion();
    })
    .then(() => console.log("Todas las funciones ejecutadas"))
    .catch((error) => console.error("Hubo un error", error));