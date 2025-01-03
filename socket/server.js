const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const mysql = require('mysql2/promise');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"]
  }
});

// Create MySQL connection pool
const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'wetrack',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

io.on('connection', (socket) => {
  console.log('New client connected');

  socket.on('join', (data) => {
    console.log('Client joined room:', data);
    socket.join(`${data.nik}-${data.nrt}`);
  });

  socket.on('sendLocation', async (data) => {
    console.log('Received location update:', data);
    
    try {
      // Update location in the mantan_narapidana table
      await pool.execute(
        'UPDATE mantan_narapidana SET geofence_lat = ?, geofence_lng = ? WHERE nik = ? AND nrt = ?',
        [data.lat, data.lng, data.nik, data.nrt]
      );

      // Insert new location record in prisoner_location table
      await pool.execute(
        'INSERT INTO prisoner_location (prisoner_id, nrt, latitude, longitude) VALUES (?, ?, ?, ?)',
        [data.nik, data.nrt, data.lat, data.lng]
      );

      console.log('Location updated in database');
      socket.emit('locationUpdateStatus', { status: 'success', message: 'Location updated successfully' });
      
      // Broadcast the location update to all clients in the room
      io.to(`${data.nik}-${data.nrt}`).emit('locationUpdate', { lat: data.lat, lng: data.lng });
    } catch (error) {
      console.error('Error updating location in database:', error);
      socket.emit('locationUpdateStatus', { status: 'error', message: 'Failed to update location in database' });
    }
  });

  socket.on('disconnect', () => {
    console.log('Client disconnected');
  });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});