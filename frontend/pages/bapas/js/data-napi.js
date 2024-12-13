document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');

    // Sidebar toggle functionality
    const sidebar = document.querySelector('.sidebar');
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const content = document.querySelector('.content');
    const toggleIcon = toggleSidebar.querySelector('i');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');
            
            // Change icon
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }
        });
    }

    // Live location map functionality
    let map;
    let marker;

    function initMap(lat, lng) {
        // Initialize the map
        map = L.map('map').setView([lat, lng], 13);

        // Add the OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker for the current location
        marker = L.marker([lat, lng]).addTo(map);
    }

    function updateLocation(lat, lng) {
        if (map && marker) {
            // Update the marker position
            marker.setLatLng([lat, lng]);
            
            // Center the map on the new position
            map.setView([lat, lng], 13);
        } else {
            // If map is not initialized, initialize it
            initMap(lat, lng);
        }
    }

    // Function to get current location
    function getCurrentLocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                updateLocation(lat, lng);
            }, function(error) {
                console.error("Error getting location:", error);
                alert("Tidak dapat mendapatkan lokasi Anda. Pastikan Anda telah memberikan izin lokasi.");
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
            alert("Geolokasi tidak didukung oleh browser Anda.");
        }
    }

    // Get initial location
    getCurrentLocation();

    // Update location every 10 seconds
    setInterval(getCurrentLocation, 10000);
});

