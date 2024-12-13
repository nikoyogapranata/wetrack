let map;
let marker;

function initMap() {
    map = L.map('map').setView([0, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    marker = L.marker([0, 0]).addTo(map);

    updateLocation();
}

function updateLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.watchPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            marker.setLatLng([lat, lon]);
            map.setView([lat, lon], 15);
        }, function(error) {
            console.error("Error: " + error.message);
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

document.addEventListener('DOMContentLoaded', initMap);