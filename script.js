// script.js
// Función para agregar marcadores al hacer doble clic en el mapa
function onMapClick(e) {
    const popupContent = `
        <form id="markerForm">
            <label for="nombre">Nombre del punto de carga:</label><br>
            <input type="text" id="nombre" name="nombre"><br>
            <label for="velocidad">Velocidad de carga:</label><br>
            <input type="text" id="velocidad" name="velocidad"><br>
            <label for="horario">Horario de funcionamiento:</label><br>
            <input type="text" id="horario" name="horario"><br>
            <label for="valoracion">Valoración:</label><br>
            <select id="valoracion" name="valoracion">
                <option value="perfecto">👍 Verde - Perfecto</option>
                <option value="aceptable">😐 Amarillo - Aceptable</option>
                <option value="mejorable">😕 Naranja - Mejorable</option>
                <option value="fuera de servicio">❌ Rojo - Fuera de Servicio</option>
            </select><br><br>
            <button type="button" onclick="guardarDatos()">Guardar</button>
        </form>
    `;
    const marker = L.marker(e.latlng).addTo(map);
    marker.bindPopup(popupContent).openPopup();
}

map.on('dblclick', onMapClick);
