<?php
require __DIR__ . '/../../config/connection.php';  // Corrected path
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM mantan_narapidana WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: data.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Prisoner Database</title>
    <link rel="stylesheet" href="/wetrack/Lapas/css/dataNapi.css">
    <script src="/wetrack/Lapas/js/dataNapi.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="/wetrack/Lapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        .icon-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .icon-container i{
            color: var(--primary-color);
            font-weight: bold;
        }

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
                    <img src="/wetrack/Lapas/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/Lapas/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li class="active"><a href="/wetrack/Lapas/pages/data.php"><i class="fas fa-database"></i>
                            <span>Prisoner Database</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/Laporan.php"><i class="fas fa-file-invoice"></i>
                            <span>Final Report</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/setting.php"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="/wetrack/Lapas/Image/lapas-logo.png" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2>Serdy Fambo</h2>
                    <p>Administrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">
            <div class="profile-card">
                <div class="icon-container">
                    <div class="path-to-back">
                        <a href="/wetrack/lapas/pages/data.php"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="edit-data">
                        <a href="/wetrack/lapas/pages/editNapi.php?id=<?php echo $id; ?>"><i class="fas fa-edit"></i></a>
                    </div>
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
                        <h1><?php echo $row["nama"]; ?></h1>
                        <p class="id-text">National ID Number: <?php echo $row["nik"]; ?></p>
                        <p class="id-text">Prisoner Registration Number: <?php echo $row["nrt"]; ?></p>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="info-section">
                        <h2>Personal Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Date of Birth:</label>
                                <span><?php echo $row["dateBirth"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Address:</label>
                                <span><?php echo $row["address"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Gender:</label>
                                <span><?php echo $row["gender"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Nationality:</label>
                                <span><?php echo $row["nationality"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Type of Crime:</label>
                                <span><?php echo $row["crime"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Incident Report:</label>
                                <span><?php echo $row["case"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Punishment Period:</label>
                                <span><?php echo $row["punishment"]; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Release Date:</label>
                                <span><?php echo $row["releaseDate"]; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>