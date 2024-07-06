document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([40.4168, -3.7038], 6); // Centrar el mapa en España

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Ejemplo de marcador estático
    L.marker([40.4168, -3.7038]).addTo(map)
        .bindPopup('¡Hola! Este es un marcador de ejemplo.')
        .openPopup();

    // Ejemplo de evento para añadir marcadores
    map.on('click', function(e) {
        var popup = prompt('Introduce el nombre del punto de carga:');
        if (popup) {
            L.marker(e.latlng).addTo(map)
                .bindPopup(popup)
                .openPopup();
        }
    });
});
