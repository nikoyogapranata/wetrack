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

const PORT = 3000;

// Create MySQL connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'your_mysql_username',
  password: 'your_mysql_password',
  database: 'wetrack'
});

connection.connect((err) => {
  if (err) {
    console.error('Error connecting to database:', err);
    return;
  }
  console.log('Connected to database');
});

// WebSocket for real-time communication
io.on('connection', (socket) => {
  console.log('User connected:', socket.id);

  socket.on('join', (data) => {
    console.log('User joined room:', data.nik, data.nrt);
    socket.join(`${data.nik}-${data.nrt}`);
  });

  socket.on('sendLocation', (locationData) => {
    console.log('Received location:', locationData);
    
    // Update location in database
    const query = 'UPDATE prisoner_geofence SET centerLat = ?, centerLng = ? WHERE nik = ? AND nrt = ?';
    connection.query(query, [locationData.lat, locationData.lng, locationData.nik, locationData.nrt], (error, results) => {
      if (error) {
        console.error('Error updating location:', error);
        return;
      }
      console.log('Location updated in database');
    });

    // Emit location update to specific room
    io.to(`${locationData.nik}-${locationData.nrt}`).emit('locationUpdate', locationData);
  });

  socket.on('disconnect', () => {
    console.log('User disconnected');
  });
});

server.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});

