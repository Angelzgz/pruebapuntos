// Inicialización del mapa centrado en España
var map = L.map('map').setView([40.4165, -3.70256], 6);

// Capa de mapa base
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Función para añadir marcador al mapa
function addMarker(lat, lng) {
    // Define un icono personalizado con AwesomeMarkers
    var customIcon = L.AwesomeMarkers.icon({
        icon: 'bolt', // Icono de un rayo
        markerColor: 'orange' // Color del marcador
    });

    // Crea el marcador con el icono personalizado y lo añade al mapa
    var marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);

    // Abre un popup con un formulario al hacer clic en el marcador
    marker.bindPopup(`<form id="form-${lat}-${lng}">
        <label for="nombre">Nombre del punto:</label><br>
        <input type="text" id="nombre-${lat}-${lng}" name="nombre"><br>
        <label for="velocidad">Velocidad de carga:</label><br>
        <input type="text" id="velocidad-${lat}-${lng}" name="velocidad"><br>
        <label for="horario">Horario:</label><br>
        <input type="text" id="horario-${lat}-${lng}" name="horario"><br>
        <label for="valoracion">Valoración:</label><br>
        <select id="valoracion-${lat}-${lng}" name="valoracion">
            <option value="verde">Verde (Perfecto)</option>
            <option value="rojo">Rojo (Malo)</option>
            <option value="amarillo">Amarillo (Aceptable)</option>
            <option value="gris">Gris (Fuera de servicio)</option>
        </select><br>
        <button type="button" onclick="guardarDatos(${lat}, ${lng})">Guardar</button>
    </form>`);

    // Escucha el evento de apertura del popup y asigna dinámicamente el evento onclick
    marker.on('popupopen', function() {
        var form = document.getElementById(`form-${lat}-${lng}`);
        var btnGuardar = form.querySelector('button');
        btnGuardar.onclick = function() {
            guardarDatos(lat, lng);
        };
    });
}

// Función para guardar datos en la base de datos
function guardarDatos(lat, lng) {
    var form = document.getElementById(`form-${lat}-${lng}`);
    var nombre = form.elements["nombre"].value;
    var velocidad = form.elements["velocidad"].value;
    var horario = form.elements["horario"].value;
    var valoracion = form.elements["valoracion"].value;

    // Envía los datos al servidor usando Axios
    axios.post('http://localhost/mapa_puntos/guardar_datos.php', {
        latitud: lat,
        longitud: lng,
        nombre: nombre,
        velocidad: velocidad,
        horario: horario,
        valoracion: valoracion
    })
    .then(function(response) {
        console.log('Datos guardados correctamente:', response.data);
        alert('Datos guardados correctamente');
    })
    .catch(function(error) {
        console.error('Error al guardar en la base de datos:', error);
        alert('Error al guardar en la base de datos');
    });
}

// Listener para añadir marcadores al hacer doble clic en el mapa
map.on('dblclick', function(event) {
    var lat = event.latlng.lat;
    var lng = event.latlng.lng;
    addMarker(lat, lng);
});
