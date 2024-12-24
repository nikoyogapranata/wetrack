let map;
let markers = {};

function initMap(geofences) {
    map = L.map('map').setView([-7.7956, 110.3695], 12); // Centered on Yogyakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add geofences to the map
    geofences.forEach(function(geofence) {
        let circle = L.circle([geofence.centerLat, geofence.centerLng], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.2,
            radius: geofence.radiusFence * 1000 // Convert km to meters
        }).addTo(map);

        circle.bindPopup("Geofence for: " + geofence.nama);
    });

    // Initialize Socket.io connection
    const socket = io('http://localhost:3000');

    socket.on('locationUpdate', function(data) {
        updateMarker(data.nik, data.lat, data.lng);
    });
}

function updateMarker(nik, lat, lng) {
    if (markers[nik]) {
        markers[nik].setLatLng([lat, lng]);
    } else {
        markers[nik] = L.marker([lat, lng]).addTo(map);
    }
    map.setView([lat, lng], 15);
}

