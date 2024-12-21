<?php
require 'connection.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM mantan_narapidana WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: dataBapas.php");
    exit();
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
                <img src="/wetrack/bapas/Image/bapas-logo.png" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2>Serdy Fambo</h2>
                    <p>Administrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">
            <?php
            require 'connection.php';
            $rows = mysqli_query($conn, "SELECT * FROM mantan_narapidana ORDER BY id DESC");
            foreach ($rows as $row) :
            ?>
            <div class="profile-card">
                <div class="path-to-back">
                    <a href="/wetrack/bapas/pages/dataBapas.php"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="profile-header">
                    <img src="/wetrack/Bapas/Image/20240305.webp" alt="Profile Image" class="profile-image">
                    <div class="profile-title">
                        <h1>
                            <?php echo $row["nama"]; ?>
                        </h1>
                        <p class="id-text">National ID Number:
                            <?php echo $row["nik"]; ?>
                        </p>
                        <p class="id-text">Prisoner Registration Number:
                            <?php echo $row["nrt"]; ?>
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
                                    <?php echo $row["dateBirth"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Address:</label>
                                <span>
                                    <?php echo $row["address"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Gender:</label>
                                <span>
                                    <?php echo $row["gender"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Nationality:</label>
                                <span>
                                    <?php echo $row["nationality"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Type of Crime:</label>
                                <span>
                                    <?php echo $row["crime"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Incident Report:</label>
                                <span>
                                    <?php echo $row["case"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Punishment Period:</label>
                                <span>
                                    <?php echo $row["punishment"]; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <label>Release Date:</label>
                                <span>
                                    <?php echo $row["releaseDate"]; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="info-section">
                        <h2>Violation History</h2>
                    </div>
                    <div class="info-section">
                        <h2>Tracking Map</h2>
                        <div class="map"></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </main>
    </div>
</body>

</html>