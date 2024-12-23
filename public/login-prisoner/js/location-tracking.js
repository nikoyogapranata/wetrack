// Establish Socket.IO connection
const socket = io('http://localhost:3000', {
  reconnection: true,
  reconnectionAttempts: 5,
  reconnectionDelay: 1000,
});

socket.on('connect', () => {
  console.log('Connected to Socket.IO server');
  document.getElementById('location-message').textContent = 'Connected to real-time tracking';
  document.getElementById('location-message').style.color = 'green';
});

socket.on('connect_error', (error) => {
  console.error('Connection error:', error);
  document.getElementById('location-message').textContent = 'Error connecting to real-time tracking. Please try again later.';
  document.getElementById('location-message').style.color = 'red';
});

socket.on('disconnect', () => {
  console.log('Disconnected from Socket.IO server');
  document.getElementById('location-message').textContent = 'Disconnected from real-time tracking';
  document.getElementById('location-message').style.color = 'orange';
});

// Function to send location update
function sendLocationUpdate(lat, lng, nik, nrt) {
  socket.emit('sendLocation', { lat, lng, nik, nrt }, (response) => {
    if (response && response.status === 'success') {
      console.log('Location update sent successfully');
    } else {
      console.error('Failed to send location update:', response ? response.message : 'No response');
    }
  });
}

// Function to get current location
function getCurrentLocation() {
  return new Promise((resolve, reject) => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(
        function(position) {
          const lat = position.coords.latitude;
          const lng = position.coords.longitude;
          resolve({ lat, lng });
        },
        function(error) {
          console.error("Error getting location:", error);
          reject(error);
        },
        { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
      );
    } else {
      reject(new Error("Geolocation is not supported by this browser."));
    }
  });
}

// Start tracking location when the page loads
document.addEventListener('DOMContentLoaded', function() {
  const loginForm = document.getElementById('login-form');
  const locationMessage = document.getElementById('location-message');
  
  loginForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const nikInput = document.getElementById('id');
    const nrtInput = document.getElementById('password');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    
    try {
      const { lat, lng } = await getCurrentLocation();
      latitudeInput.value = lat;
      longitudeInput.value = lng;
      
      sessionStorage.setItem('nik', nikInput.value);
      sessionStorage.setItem('nrt', nrtInput.value);
      
      // Join the room for this specific prisoner
      socket.emit('join', { nik: nikInput.value, nrt: nrtInput.value });
      
      // Send initial location update
      sendLocationUpdate(lat, lng, nikInput.value, nrtInput.value);
      
      // Continue with form submission
      this.submit();
    } catch (error) {
      console.error("Error:", error);
      locationMessage.textContent = "Error: Unable to access your location. Please enable location services and try again.";
      locationMessage.style.color = 'red';
    }
  });
});

// Update location every 5 minutes (300000 ms)
setInterval(async () => {
  const nik = sessionStorage.getItem('nik');
  const nrt = sessionStorage.getItem('nrt');
  
  if (nik && nrt) {
    try {
      const { lat, lng } = await getCurrentLocation();
      sendLocationUpdate(lat, lng, nik, nrt);
    } catch (error) {
      console.error("Error updating location:", error);
    }
  }
}, 300000);