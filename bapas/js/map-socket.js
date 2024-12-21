let map, circle, geocoder;

function initMap() {
    map = L.map('map').setView([-7.7956, 110.3695], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Search address...',
        geocoder: L.Control.Geocoder.nominatim()
    }).on('markgeocode', function(e) {
        updateGeofence(e.geocode.center);
    }).addTo(map);

    map.on('click', function(e) {
        updateGeofence(e.latlng);
    });

    document.getElementById('radiusFence').addEventListener('input', function() {
        if (circle) {
            updateGeofence(circle.getLatLng());
        }
    });
}

function updateGeofence(latlng) {
    const radius = parseFloat(document.getElementById('radiusFence').value) * 1000; // Convert km to meters

    if (circle) {
        map.removeLayer(circle);
    }

    circle = L.circle(latlng, {radius: radius}).addTo(map);
    
    // Update hidden form fields with more precise values
    document.getElementById('centerLat').value = latlng.lat;
    document.getElementById('centerLng').value = latlng.lng;

    map.setView(latlng);
}