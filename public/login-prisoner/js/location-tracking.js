// Establish Socket.IO connection
const socket = io('http://localhost:3000');

socket.on('connect', () => {
  console.log('Connected to Socket.IO server');
});

// Function to send location update
function sendLocationUpdate(lat, lng, nik, nrt) {
  socket.emit('sendLocation', { lat, lng, nik, nrt });
}

// Function to get current location
function getCurrentLocation() {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
      const lat = position.coords.latitude;
      const lng = position.coords.longitude;
      const nik = sessionStorage.getItem('nik');
      const nrt = sessionStorage.getItem('nrt');
      
      if (nik && nrt) {
        sendLocationUpdate(lat, lng, nik, nrt);
      }
    }, function(error) {
      console.error("Error getting location:", error);
    });
  } else {
    console.error("Geolocation is not supported by this browser.");
  }
}

// Start tracking location when the page loads
document.addEventListener('DOMContentLoaded', function() {
  const loginForm = document.getElementById('login-form');
  
  loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nikInput = document.getElementById('id');
    const nrtInput = document.getElementById('password');
    
    sessionStorage.setItem('nik', nikInput.value);
    sessionStorage.setItem('nrt', nrtInput.value);
    
    // Join the room for this specific prisoner
    socket.emit('join', { nik: nikInput.value, nrt: nrtInput.value });
    
    // Start tracking location
    getCurrentLocation();
    
    // Continue with form submission
    this.submit();
  });
});

// Update location every 5 minutes (300000 ms)
setInterval(getCurrentLocation, 300000);

