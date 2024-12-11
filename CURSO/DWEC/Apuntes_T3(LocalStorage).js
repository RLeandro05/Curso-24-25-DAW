//Llamar a un item
localStorage.getItem(item); //V1
localStorage[item]; //V2

//--------------------------------------------------------

//Guardar un nuevo valor en localStorage
localStorage.setItem("nameItem", valorItem); //V1
localStorage["nameItem"] = valorItem; //V2

//--------------------------------------------------------

//Crear un contador de visitas en localStorage
window.onload = () => {
    let visitas = localStorage.getItem("visitas");

    if (visitas === null) {
        visitas = 0;
    } else {
        visitas = parseInt(visitas);
    }

    visitas++;

    localStorage.setItem("visitas", visitas);
}

//--------------------------------------------------------

//Remover o borrar un elemento de localStorage
localStorage.removeItem(item);

//--------------------------------------------------------

//Mostrar llave de un elemento en localStorage
localStorage.key(i); //i se refiere a un número, como si se tratase de un array

//--------------------------------------------------------

//Mostrar llave y valor asignado a la llave
let bloque = "";

for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i);
    let contenido = localStorage.getItem(key);

    bloque += key + " - " + contenido + "<br><br>";
}