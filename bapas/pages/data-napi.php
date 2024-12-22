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
    $query = "SELECT * FROM mantan_narapidana WHERE id = ?";
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
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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
                    <img src="<?php echo $prisoner_data['fileInput']; ?>" alt="Profile Image" class="profile-image">
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
                        <h2>Violation History</h2>
                        <!-- Add violation history content here if available -->
                    </div>
                    <div class="info-section">
                        <h2>Geofence Information</h2>
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
                    </div>
                    <div class="info-section">
                        <h2>Tracking Map</h2>
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        var map = L.map('map').setView([0, 0], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var centerLat = <?php echo $prisoner_data['centerLat']; ?>;
        var centerLng = <?php echo $prisoner_data['centerLng']; ?>;
        var radiusFence = <?php echo isset($prisoner_data['radiusFence']) ? $prisoner_data['radiusFence'] : 'null'; ?>;

        if (centerLat && centerLng && radiusFence) {
            var circle = L.circle([centerLat, centerLng], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.2,
                radius: radiusFence * 1000 // Convert km to meters
            }).addTo(map);

            // Add a marker for the center point
            var marker = L.marker([centerLat, centerLng]).addTo(map);
            marker.bindPopup("Center of Geofence").openPopup();

            map.fitBounds(circle.getBounds());
        } else {
            console.log('No geofence data available for this prisoner');
            map.setView([0, 0], 2); // Set a default view if no geofence data
        }
    </script>
</body>

</html>