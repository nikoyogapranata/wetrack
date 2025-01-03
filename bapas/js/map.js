let map;
let markers = {};

function initMap(prisonerLocations) {
    map = L.map('map').setView([-7.7956, 110.3695], 12); // Centered on Yogyakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add markers for each prisoner's location
    prisonerLocations.forEach(function(prisoner) {
        let marker = L.marker([prisoner.latitude, prisoner.longitude]).addTo(map);
        marker.bindPopup("Prisoner: " + prisoner.nama);
        markers[prisoner.prisoner_id] = marker;
    });

    // Initialize Socket.io connection
    const socket = io('http://localhost:3000');

    socket.on('locationUpdate', function(data) {
        updateMarker(data.nik, data.lat, data.lng, data.nama);
    });
}

function updateMarker(nik, lat, lng, nama) {
    if (markers[nik]) {
        markers[nik].setLatLng([lat, lng]);
    } else {
        markers[nik] = L.marker([lat, lng]).addTo(map);
        markers[nik].bindPopup("Prisoner: " + nama);
    }
    map.setView([lat, lng], 15);
}