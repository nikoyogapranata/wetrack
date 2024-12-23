const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const mysql = require('mysql2');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"]
  }
});

// Create MySQL connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'wetrack'
});

connection.connect((err) => {
  if (err) {
    console.error('Error connecting to MySQL database:', err);
    return;
  }
  console.log('Connected to MySQL database');
});

io.on('connection', (socket) => {
  console.log('New client connected');

  socket.on('join', (data) => {
    console.log('Client joined room:', data);
    socket.join(`${data.nik}-${data.nrt}`);
  });

  socket.on('sendLocation', (data) => {
    console.log('Received location update:', data);
    
    // Update location in the database
    const query = 'UPDATE prisoner_geofence SET centerLat = ?, centerLng = ? WHERE nik = ? AND nrt = ?';
    connection.query(query, [data.lat, data.lng, data.nik, data.nrt], (error, results) => {
      if (error) {
        console.error('Error updating location in database:', error);
        socket.emit('locationUpdateStatus', { status: 'error', message: 'Failed to update location in database' });
      } else {
        console.log('Location updated in database');
        socket.emit('locationUpdateStatus', { status: 'success', message: 'Location updated successfully' });
        
        // Broadcast the location update to all clients in the room
        io.to(`${data.nik}-${data.nrt}`).emit('locationUpdate', { lat: data.lat, lng: data.lng });
      }
    });
  });

  socket.on('disconnect', () => {
    console.log('Client disconnected');
  });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});