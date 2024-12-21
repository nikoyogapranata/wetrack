import geoJsonData from '../geojson/districts.json';

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
    
    document.getElementById('centerLat').value = latlng.lat.toFixed(6);
    document.getElementById('centerLng').value = latlng.lng.toFixed(6);

    map.setView(latlng);
}

document.addEventListener('DOMContentLoaded', function() {
    const typePrisonerSelect = document.getElementById('typePrisoner');
    typePrisonerSelect.addEventListener('change', togglePrisonerTypeFields);

    const showInputBtn = document.getElementById('showInputBtn');
    showInputBtn.addEventListener('click', function() {
        document.querySelector('.input-container').style.display = 'block';
        if (document.getElementById('typePrisoner').value === 'houseArrest') {
            setTimeout(initMap, 100);
        } else if (document.getElementById('typePrisoner').value === 'cityPrisoner') {
            setTimeout(initCityMap, 100);
        }
    });
});

function togglePrisonerTypeFields() {
    const prisonerType = document.getElementById('typePrisoner').value;
    const houseArrestFields = document.getElementById('houseArrestFields');
    const cityPrisonerFields = document.getElementById('cityPrisonerFields');

    houseArrestFields.style.display = prisonerType === 'houseArrest' ? 'block' : 'none';
    cityPrisonerFields.style.display = prisonerType === 'cityPrisoner' ? 'block' : 'none';

    if (prisonerType === 'houseArrest' && !map) {
        setTimeout(initMap, 100);
    } else if (prisonerType === 'cityPrisoner') {
        initCityMap();
    }
}


function initCityMap() {
    if (!map) {
        map = L.map('map').setView([-7.7956, 110.3695], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    }

    const kotaKabSelect = document.getElementById('kotaKab');
    kotaKabSelect.addEventListener('change', function() {
        const selectedDistrict = this.value;
        const districtFeature = geoJsonData.features.find(feature => feature.properties.name === selectedDistrict);
        
        if (districtFeature) {
            if (map.geoJsonLayer) {
                map.removeLayer(map.geoJsonLayer);
            }
            map.geoJsonLayer = L.geoJSON(districtFeature).addTo(map);
            map.fitBounds(map.geoJsonLayer.getBounds());
        }
    });
}

