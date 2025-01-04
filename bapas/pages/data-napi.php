<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require __DIR__ . '/../../config/connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /wetrack/public/login-admin/index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$query = "SELECT id, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

if (!$profile_picture) {
    $profile_picture = '/wetrack/kemenkumham/Image/kemenkumham.png';
}

// Fetch ex-prisoner data
if (isset($_GET['id'])) {
    $prisoner_id = $_GET['id'];
    $query = "SELECT mn.*, pl.latitude as real_lat, pl.longitude as real_lng, pl.timestamp as last_update
              FROM mantan_narapidana mn 
              LEFT JOIN (
                  SELECT prisoner_id, latitude, longitude, timestamp
                  FROM prisoner_location
                  WHERE (prisoner_id, timestamp) IN (
                      SELECT prisoner_id, MAX(timestamp)
                      FROM prisoner_location
                      GROUP BY prisoner_id
                  )
              ) pl ON mn.nik = pl.prisoner_id
              WHERE mn.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $prisoner_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $prisoner_data = $result->fetch_assoc();
    $stmt->close();

    if (!$prisoner_data) {
        die("No data found for this ID.");
    }
} else {
    die("No ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Database</title>
    <link rel="stylesheet" href="/wetrack/bapas/css/data-napi.css">
    <script src="/wetrack/bapas/js/data-napi.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="/wetrack/bapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
    <style>
        @media screen and (max-width: 1024px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 60px;
                background: var(--primary-color);
                display: flex;
                flex-direction: row;
                align-items: center;
                padding: 0 1rem;
                transform: none;
            }

            .sidebar-header {
                margin: 0;
                padding: 0;
                flex: 0 0 auto;
            }

            .logo {
                padding: 0;
                margin-right: 1rem;
            }

            .logo img {
                width: 30px;
                height: 30px;
            }

            .logo-text {
                font-size: 1rem;
            }

            .nav-links {
                margin: 0;
                margin-left: auto;
            }

            .nav-links ul {
                flex-direction: row;
                gap: 1.5rem;
                justify-content: flex-end;
                padding-right: 1rem;
            }

            .nav-links li {
                width: auto;
            }

            .nav-links li a {
                padding: 0.5rem;
            }

            .nav-links li a span {
                display: none;
            }

            .nav-links li a i {
                font-size: 1.2rem;
            }

            .content {
                margin-left: 0;
                margin-top: 60px;
                padding-top: 1rem;
            }

            .content.shifted {
                margin-left: 0;
            }

            .toggle-sidebar,
            .user-profile {
                display: none;
            }

            /* Active state for navigation items */
            .nav-links li.active a {
                background: none;
                color: var(--accent-color);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="/wetrack/bapas/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/bapas/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/bapas/pages/tracking.php"><i class="fas fa-map-marker-alt"></i><span>
                                Tracking Map</span></a></li>
                    <li class="active"><a href="/wetrack/bapas/pages/dataBapas.php"><i class="fas fa-database"></i>
                            <span>Prisoner Database</span></a></li>

                </ul>
            </nav>
            <div class="user-profile">
                <img src="<?php echo $profile_picture; ?>" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2><?php echo htmlspecialchars($id); ?></h2>
                    <p>Administrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">
            <div class="profile-card">
                <div class="path-to-back">
                    <a href="/wetrack/bapas/pages/dataBapas.php"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="profile-header">
                    <?php
                    if (isset($prisoner_data["fileInput"]) && !empty($prisoner_data["fileInput"])) {
                        // Update path to match your actual directory structure
                        $image_path = '/wetrack/lapas/pages/' . $prisoner_data["fileInput"];
                        echo '<img src="' . htmlspecialchars($image_path) . '" alt="Profile Image" class="profile-image">';
                    } else {
                        echo '<img src="/wetrack/lapas/image/nanti-diganti.png" alt="Default Photo" class="profile-image">';
                    }
                    ?>
                    <div class="profile-title">
                        <h1><?php echo htmlspecialchars($prisoner_data["nama"]); ?></h1>
                        <p class="id-text">National ID Number: <?php echo htmlspecialchars($prisoner_data["nik"]); ?></p>
                        <p class="id-text">Prisoner Registration Number: <?php echo htmlspecialchars($prisoner_data["nrt"]); ?></p>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="info-section">
                        <h2>Personal Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Date of Birth:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["dateBirth"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Address:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["address"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Gender:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["gender"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Nationality:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["nationality"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Type of Crime:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["crime"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Incident Report:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["case"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Punishment Period:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["punishment"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Release Date:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["releaseDate"]); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="info-section">
                        <h2>Violation Report</h2>
                        <!-- Add violation report content here if available -->
                    </div>
                    <div class="info-section">
                        <h2>Tracking Map</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Prisoner Type:</label>
                                <span><?php echo htmlspecialchars($prisoner_data["geofence_type"]); ?></span>
                            </div>
                            <?php if ($prisoner_data["geofence_type"] == "houseArrest"): ?>
                                <div class="info-item">
                                    <label>Geofence Radius:</label>
                                    <span><?php echo isset($prisoner_data["geofence_radius"]) ? htmlspecialchars($prisoner_data["geofence_radius"]) . " km" : "Not set"; ?></span>
                                </div>
                            <?php elseif ($prisoner_data["geofence_type"] == "cityPrisoner"): ?>
                                <div class="info-item">
                                    <label>City/District:</label>
                                    <span><?php echo htmlspecialchars($prisoner_data["geofence_city_district"]); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="info-item">
                                <label>Last Update:</label>
                                <span id="last-update"><?php echo isset($prisoner_data["last_update"]) ? htmlspecialchars($prisoner_data["last_update"]) : "N/A"; ?></span>
                            </div>
                        </div>
                        <div id="prisoner-map" style="height: 400px;"></div>
                        <div id="connection-status"></div>
                        <button class="report-btn" id="report-btn" class="btn btn-danger">Report</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            sidebar.classList.toggle('active');
            content.classList.toggle('shifted');
        });

        document.addEventListener('DOMContentLoaded', function() {
            var prisonerMap = L.map('prisoner-map').setView([0, 0], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(prisonerMap);

            var geofenceLat = <?php echo $prisoner_data['geofence_lat'] ?? 'null'; ?>;
            var geofenceLng = <?php echo $prisoner_data['geofence_lng'] ?? 'null'; ?>;
            var radiusFence = <?php echo $prisoner_data['geofence_radius'] ?? 'null'; ?>;
            var realLat = <?php echo $prisoner_data['real_lat'] ?? 'null'; ?>;
            var realLng = <?php echo $prisoner_data['real_lng'] ?? 'null'; ?>;

            var circle, geofenceMidpointMarker, realTimeMarker;

            function initPrisonerMap() {
                if (geofenceLat && geofenceLng) {
                    prisonerMap.setView([geofenceLat, geofenceLng], 13);

                    if (radiusFence) {
                        circle = L.circle([geofenceLat, geofenceLng], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.2,
                            radius: radiusFence * 1000 // Convert km to meters
                        }).addTo(prisonerMap);
                    }

                    geofenceMidpointMarker = L.marker([geofenceLat, geofenceLng], {
                        icon: L.icon({
                            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        })
                    }).addTo(prisonerMap);
                    geofenceMidpointMarker.bindPopup("Geofence Midpoint").openPopup();
                } else {
                    console.log('No geofence data available for this prisoner');
                    prisonerMap.setView([0, 0], 2);
                }

                if (realLat && realLng) {
                    updateRealTimeMarker(realLat, realLng);
                }
            }

            function updateRealTimeMarker(lat, lng) {
                if (realTimeMarker) {
                    realTimeMarker.setLatLng([lat, lng]);
                } else {
                    realTimeMarker = L.marker([lat, lng], {
                        icon: L.icon({
                            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        })
                    }).addTo(prisonerMap);
                }
                realTimeMarker.bindPopup("Prisoner's Real-time Location").openPopup();

                if (circle) {
                    var bounds = circle.getBounds();
                    bounds.extend(realTimeMarker.getLatLng());
                    prisonerMap.fitBounds(bounds);
                } else {
                    prisonerMap.setView(realTimeMarker.getLatLng(), 13);
                }
            }

            initPrisonerMap();

            // Socket.IO connection
            const socket = io('http://localhost:3000', {
                reconnection: true,
                reconnectionAttempts: 5,
                reconnectionDelay: 1000,
            });

            const connectionStatus = document.getElementById('connection-status');
            const lastUpdateElement = document.getElementById('last-update');

            socket.on('connect', () => {
                console.log('Connected to Socket.IO server');
                connectionStatus.textContent = 'Connected to real-time tracking';
                connectionStatus.style.color = 'green';
                socket.emit('join', {
                    nik: '<?php echo $prisoner_data["nik"]; ?>',
                    nrt: '<?php echo $prisoner_data["nrt"]; ?>'
                });
            });

            socket.on('connect_error', (error) => {
                console.error('Connection error:', error);
                connectionStatus.textContent = 'Error connecting to real-time tracking';
                connectionStatus.style.color = 'red';
            });

            socket.on('locationUpdate', (data) => {
                console.log('Received location update:', data);
                if (data.lat && data.lng) {
                    updateRealTimeMarker(data.lat, data.lng);
                    lastUpdateElement.textContent = new Date().toLocaleString();

                    if (circle) {
                        var distance = prisonerMap.distance([data.lat, data.lng], [geofenceLat, geofenceLng]) / 1000; // in km
                        if (distance > radiusFence) {
                            alert('Prisoner has left the geofence!');
                        }
                    }
                } else {
                    console.log('Invalid location data received');
                }
            });

            socket.on('disconnect', () => {
                console.log('Disconnected from Socket.IO server');
                connectionStatus.textContent = 'Disconnected from real-time tracking';
                connectionStatus.style.color = 'orange';
            });
        });
    </script>
</body>

</html>

