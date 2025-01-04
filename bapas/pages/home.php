<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require __DIR__ . '/../../config/connection.php';  // Corrected path

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Dashboard</title>
    <link rel="stylesheet" href="/wetrack/bapas/css/style.css">
    <script src="/wetrack/Bapas/js/script.js"></script>
    <link rel="icon" href="/wetrack/Bapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <img src="/wetrack/Bapas/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li class="active"><a href="/wetrack/Bapas/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/Bapas/pages/tracking.php"><i class="fas fa-map-marker-alt"></i> <span>Tracking Map</span></a></li>
                    <li><a href="/wetrack/Bapas/pages/dataBapas.php"><i class="fas fa-database"></i> <span>Prisoner Database</span></a>
                    </li>
                    
                </ul>
            </nav>
            <div class="user-profile">
                <img src="<?php echo $profile_picture; ?>" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2><?php echo htmlspecialchars($id); ?></h2> <!-- Dynamically displays the user ID -->
                    <p>Administrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">
            <div class="dashboard-grid">
                <section class="card summary-card">
                    <h3><i class="fas fa-users"></i>Total Tracked Individuals</h3>
                    <div class="card-content">
                        <span class="number">5</span>
                    </div>
                </section>
                <section class="card alert-card">
                    <h3><i class="fas fa-exclamation-triangle"></i>Active Alerts</h3>
                    <div class="card-content">
                        <span class="number">5</span>
                    </div>
                </section>
                <section class="card activity-card">
                    <h3><i class="fas fa-history"></i>Recent Activities</h3>
                    <ul class="activity-list">
                        <li>
                            <span class="time">09:45</span>
                            <span class="activity">New registration added</span>
                        </li>
                        <li>
                            <span class="time">08:30</span>
                            <span class="activity">Alert triggered in Zone B</span>
                        </li>
                        <li>
                            <span class="time">07:15</span>
                            <span class="activity">System update completed</span>
                        </li>
                        <li>
                            <span class="time">Yesterday</span>
                            <span class="activity">Monthly report generated</span>
                        </li>
                        <li>
                            <span class="time">2 days ago</span>
                            <span class="activity">New user account created</span>
                        </li>
                    </ul>
                </section>
            </div>
        </main>
    </div>

</body>

</html>