//Asegurarse de que el navegador soporta la geolocalización
if (navigator.geolocation) {
    info.innerHTML = "El navegador SOPORTA la GEOLOCALIZACIÓN";
} else {
    info.innerHTML = "Lo Sentimos. El navegador NO SOPORTA la GEOLOCALIZACIÓN";
}

//--------------------------------------------------------

//Cargar key de la api de Google Maps
/*<script type="text/javascript" 
        src="http://maps.google.com/maps/api/js?key=AIzaSyA6rLid89W1HGF2lCnQbfx62tr-57ugzdU">
</script>*/

//--------------------------------------------------------

//Obtener coordenadas y crear mapa
let divMapa = document.getElementById("divmapa");

let centro = new google.maps.LatLng(latitud, longitud);

let opciones = {
    center: centro,
    zoom: 17
};

let mapa = new google.maps.Map(divMapa, opciones);

//--------------------------------------------------------

//Crear un marcador en el mapa
let marcador = new google.maps.Marker({
    position: centro,
    map: mapa,
    title: "title"
});

//--------------------------------------------------------

//Obtener zoom de un mapa
mapa.getZoom();

//--------------------------------------------------------

//Crear un infowindow y cerrarlo
let infowindow = new google.maps.InfoWindow({
    position: { latitud, longitud },
    map: mapa,
    content: "content"
});

infowindow.close();

//--------------------------------------------------------

//Leer un fichero gpx
function Leer_Fichero(evento) {
    let e = evento || window.event;
    let fichero = e.target.files[0];

    function Convertir_a_XML(texto) {
        let xml = null;
        if (window.ActiveXObject) {
            xml = new ActiveXObject("Microsoft.XMLDOM");
            xml.loadXML(texto);
        } else {
            xml = new DOMParser().parseFromString(texto, "text/xml");
            return xml;
        }
    }

    let reader = new FileReader();

    reader.onload = function (e) {
        let miXml = Convertir_a_XML(reader.result);
        console.log("miXml: ", miXml);
        tratarXML(miXml);
    }
    reader.readAsText(fichero);
}

//--------------------------------------------------------

//Obtener elementos de un gpx
let valores = xml.getElementsByTagName("valor2");

//--------------------------------------------------------

//Obtener el valor de los nodos de un gpx
let valor = xml.getElementsByTagName("valor1")[4].value;

//--------------------------------------------------------

//Obtener el valor de un atributo en xml
let valorAtributo = valor1.getAttributeNode("atributo1").nodeValue;

//--------------------------------------------------------

//Calcular distancia en metros de varios puntos de coordenadas
let listaCoordenadas = [];

listaCoordenadas.push(new google.maps.LatLng(1, 2));
listaCoordenadas.push(new google.maps.LatLng(12354, -3256));

let distanciaM = google.maps.geometry.spherical.computeLength(listaCoordenadas);

//--------------------------------------------------------

//Sacar horas, minutos y segundos de un objeto Date
let fecha = new Date("2015-01-11T12:39:13Z");
let fecha2 = new Date("2014-01-11T12:39:13Z");

let horas = fecha.getUTCHours();
let minutos = fecha.getUTCMinutes();
let segundos = fecha.getUTCSeconds();

//--------------------------------------------------------

//Restar dos fechas en milisegundos (originalmente)
let diffFechas = new Date(fecha2 - fecha);

//--------------------------------------------------------

//Calcular velocidad en km por segundo
let diffSegundos = diff / 1000;

let velocidad = (distanciaM / 1000) / (diffSegundos / 3600);

//--------------------------------------------------------

//Pintar una ruta lineada en un mapa
listaCoordenadas = [];

listaCoordenadas.push(new google.maps.LatLng(315361, -246672));
listaCoordenadas.push(new google.maps.LatLng(12354, -3256));

new google.maps.Polyline({
    path: listaCoordenadas,
    map: mapa,
    geodesic: true,
    strokeColor: "#0000FF",
    strokeOpacity: 1.0,
    strokeWeight: 3,
    clickable: true
});

//--------------------------------------------------------

//Calcular distancia tardando de un punto a otro en coche
let directionsDisplay = new google.maps.DirectionsRenderer();
let directionsService = new google.maps.DirectionsService();

directionsDisplay.setMap(mapa);

let request = {
    origin: origen, //Escribir una ciudad inicio
    destination: destino, //Escribir una ciudad destino
    travelMode: google.maps.TravelMode.DRIVING
}

directionsService.route(request, function (result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(result); //Muestra la ruta

        // Limpiar el área de direcciones antes de agregar nuevas instrucciones
        let areaDirecciones = document.querySelector("#areaDirecciones");

        areaDirecciones.innerHTML = "";  // Limpiar el contenido del textarea

        //Puedes mostrar los pasos a seguir accediendo al array de result
        let listaPasos = result.routes[0].legs[0].steps;

        listaPasos.forEach((paso, i) => {
            areaDirecciones.innerHTML += (i + 1) + ". " + paso.instructions + "<br>";  // Usar \n para saltos de línea en el textarea
        });

        console.log(result);
    }
})