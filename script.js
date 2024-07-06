// script.js

let map;
let markers = [];

document.addEventListener('DOMContentLoaded', () => {
    map = L.map('map').setView([40.4168, -3.7038], 6); // Centra el mapa en España

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    map.on('click', onMapClick);
});

function onMapClick(e) {
    const lat = e.latlng.lat.toFixed(6);
    const lng = e.latlng.lng.toFixed(6);

    document.getElementById('latitud').value = lat;
    document.getElementById('longitud').value = lng;

    L.popup()
        .setLatLng(e.latlng)
        .setContent(`<p>Latitud: ${lat}<br>Longitud: ${lng}</p>`)
        .openOn(map);
}

function guardarDatos() {
    const nombre = document.getElementById('nombre').value;
    const latitud = document.getElementById('latitud').value;
    const longitud = document.getElementById('longitud').value;
    const velocidad = document.getElementById('velocidad').value;
    const horario = document.getElementById('horario').value;
    const valoracion = document.getElementById('valoracion').value;

    const data = {
        nombre: nombre,
        latitud: latitud,
        longitud: longitud,
        velocidad: velocidad,
        horario: horario,
        valoracion: valoracion
    };

    // Ejemplo de uso de Axios para hacer una petición POST
    axios.post('http://localhost/mapa_puntos/guardar_datos.php', data)
        .then(response => {
            console.log('Datos guardados correctamente:', response);
            alert('Punto de carga guardado correctamente');
            // Opcional: limpiar formulario o realizar otras acciones después de guardar
        })
        .catch(error => {
            console.error('Error al guardar en la base de datos:', error);
            alert('Error al guardar el punto de carga');
        });
}
