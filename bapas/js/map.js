let map;
let marker;
let socket;

function initMap() {
    map = L.map('map').setView([0, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    marker = L.marker([0, 0]).addTo(map);

    // Initialize Socket.io connection
    socket = io('http://localhost:3000');

    // Listen for location updates from the server
    socket.on('locationUpdate', function(data) {
        updateLocation(data.lat, data.lon);
    });

    // Start sending location updates to the server
    startLocationUpdates();
}

function updateLocation(lat, lon) {
    marker.setLatLng([lat, lon]);
    map.setView([lat, lon], 15);
}

function startLocationUpdates() {
    if ("geolocation" in navigator) {
        navigator.geolocation.watchPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            // Send location update to the server
            socket.emit('updateLocation', { lat, lon });
        }, function(error) {
            console.error("Error: " + error.message);
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

document.addEventListener('DOMContentLoaded', initMap);