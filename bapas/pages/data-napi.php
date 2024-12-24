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
    $query = "SELECT mn.*, pg.prisoner_type, pg.radiusFence, pg.centerLat, pg.centerLng, pg.city_district 
            FROM mantan_narapidana mn 
            LEFT JOIN prisoner_geofence pg ON mn.nik = pg.nik AND mn.nrt = pg.nrt 
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
        }</style>
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
                            <span>Database</span></a></li>

                    <li><a href="/wetrack/bapas/pages/setting.php"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
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
                    $result = $conn->query("SELECT * FROM mantan_narapidana WHERE id = $id");
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<img src="' . htmlspecialchars($row["fileInput"]) . '" alt="Profile Image" class="profile-image">';
                    } else {
                        echo '<img src="/wetrack/lapas/image/nanti-diganti.png" alt="Default Photo" class="profile-image">';
                    }
                    ?>
                    <div class="profile-title">
                        <h1>
                            <?php echo $prisoner_data["nama"]; ?>
                        </h1>
                        <p class="id-text">National ID Number:
                            <?php echo $prisoner_data["nik"]; ?>
                        </p>
                        <p class="id-text">Prisoner Registration Number:
                            <?php echo $prisoner_data["nrt"]; ?>
                        </p>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="info-section">
                        <h2>Personal Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Date of Birth:</label>
                                <span>
                                    <?php echo $prisoner_data["dateBirth"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Address:</label>
                                <span>
                                    <?php echo $prisoner_data["address"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Gender:</label>
                                <span>
                                    <?php echo $prisoner_data["gender"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Nationality:</label>
                                <span>
                                    <?php echo $prisoner_data["nationality"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Type of Crime:</label>
                                <span>
                                    <?php echo $prisoner_data["crime"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Incident Report:</label>
                                <span>
                                    <?php echo $prisoner_data["case"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Punishment Period:</label>
                                <span>
                                    <?php echo $prisoner_data["punishment"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Release Date:</label>
                                <span>
                                    <?php echo $prisoner_data["releaseDate"]; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="info-section">
                        <h2>Violation Report</h2>
                    </div>
                    <div class="info-section">
                        <div class="info-section">
                            <h2>Tracking Map</h2>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Prisoner Type:</label>
                                    <span><?php echo $prisoner_data["prisoner_type"]; ?></span>
                                </div>
                                <?php if ($prisoner_data["prisoner_type"] == "houseArrest"): ?>
                                    <div class="info-item">
                                        <label>Geofence Radius:</label>
                                        <span><?php echo isset($prisoner_data["radiusFence"]) ? $prisoner_data["radiusFence"] . " km" : "Not set"; ?></span>
                                    </div>
                                <?php elseif ($prisoner_data["prisoner_type"] == "cityPrisoner"): ?>
                                    <div class="info-item">
                                        <label>City/District:</label>
                                        <span><?php echo $prisoner_data["city_district"]; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div id="prisoner-map" style="height: 400px;"></div>
                            <div id="connection-status"></div>
                            <button class="report-btn" id="report-btn" class="btn btn-danger">Report</button>
                        </div>
                    </div>
        </main>
    </div>
    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
        })
        document.addEventListener('DOMContentLoaded', function() {
            var prisonerMap = L.map('prisoner-map').setView([0, 0], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(prisonerMap);

            var geofenceLat = <?php echo $prisoner_data['centerLat']; ?>;
            var geofenceLng = <?php echo $prisoner_data['centerLng']; ?>;
            var radiusFence = <?php echo isset($prisoner_data['radiusFence']) ? $prisoner_data['radiusFence'] : 'null'; ?>;

            var circle, prisonerMarker;
            var currentLocationMarker;

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
                        prisonerMap.fitBounds(circle.getBounds());
                    }

                    prisonerMarker = L.marker([geofenceLat, geofenceLng]).addTo(prisonerMap);
                    prisonerMarker.bindPopup("Prisoner's Last Known Location").openPopup();
                } else {
                    console.log('No geofence data available for this prisoner');
                    prisonerMap.setView([0, 0], 2);
                }
            }

            function updateMarkerPosition(lat, lng) {
                if (currentLocationMarker) {
                    currentLocationMarker.setLatLng([lat, lng]);
                } else {
                    currentLocationMarker = L.marker([lat, lng], {
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
                currentLocationMarker.bindPopup("Prisoner's Current Location").openPopup();

                if (!prisonerMap.getBounds().contains([lat, lng])) {
                    prisonerMap.fitBounds(L.latLngBounds([prisonerMarker.getLatLng(), currentLocationMarker.getLatLng()]));
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
                    updateMarkerPosition(data.lat, data.lng);

                    if (circle) {
                        var distance = prisonerMap.distance([data.lat, data.lng], [geofenceLat, geofenceLng]) / 1000; // in km
                        if (distance > radiusFence) {
                            alert('Prisoner has left the geofence!');
                        }
                    }
                } else {
                    console.log('Prisoner has not logged in yet');
                    // You can add a message to the UI here if needed
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