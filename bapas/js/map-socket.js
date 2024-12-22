// Establish Socket.IO connection
const socket = io('http://localhost:3000');

socket.on('connect', () => {
  console.log('Connected to Socket.IO server');
});

// Function to send location update
function sendLocationUpdate(lat, lng, nik, nrt) {
  socket.emit('sendLocation', { lat, lng, nik, nrt });
}

// Listen for location updates
socket.on('locationUpdate', (data) => {
  // Update the map with the new location
  if (typeof updateMarkerPosition === 'function') {
    updateMarkerPosition(data.lat, data.lng);
  }
});

// Example usage (you would call this function when you have a new location)
// sendLocationUpdate(-6.2088, 106.8456, '1234567890', 'NRT12345');

// You can call this function whenever you need to update the prisoner's location
// For example, you might call it periodically or when receiving GPS data from a tracking device

// Make sure to replace the latitude, longitude, NIK, and NRT with actual values

