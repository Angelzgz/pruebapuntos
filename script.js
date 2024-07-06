// script.js
let markers = [];

function agregarMarker(latlng) {
    const icon = L.AwesomeMarkers.icon({
        icon: 'bolt',
        markerColor: 'orange',
        prefix: 'fa'
    });

    const marker = L.marker(latlng, { icon: icon }).addTo(map);
    markers.push(marker);
    marker.bindPopup('<b>Nuevo punto de carga</b>').openPopup();
}

function guardarDatos() {
    const nombre = document.getElementById('nombre').value;
    const velocidad = document.getElementById('velocidad').value;
    const horario = document.getElementById('horario').value;
    const valoracion = document.getElementById('valoracion').value;

    const data = {
        nombre: nombre,
        velocidad: velocidad,
        horario: horario,
        valoracion: valoracion
    };

    axios.post('http://localhost/mapa_puntos/guardar_datos.php', data)
        .then(response => {
            console.log('Datos guardados correctamente:', response);
            alert('Punto de carga guardado correctamente');
        })
        .catch(error => {
            console.error('Error al guardar en la base de datos:', error);
            alert('Error al guardar el punto de carga');
        });
}
