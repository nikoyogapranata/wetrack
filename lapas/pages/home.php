<?php
require __DIR__ . '/../../config/connection.php';  // Corrected path
require_once 'utils/activity_logger.php';

// Function to log recent activity
function logRecentActivity($action_type, $action_description)
{
    global $conn;
    $query = "INSERT INTO recent_activities (action_type, action_description) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $action_type, $action_description);
    $stmt->execute();
    $stmt->close();
}

$result_data = mysqli_query($conn, "SELECT COUNT(id) as total FROM mantan_narapidana");
$result_report =  mysqli_query($conn, "SELECT COUNT(id) as total FROM final_report");

if ($result_data) {
    $row = mysqli_fetch_assoc($result_data);
    $total = $row['total'];
} else {
    $total = 0;
}

if ($result_report) {
    $row_report = mysqli_fetch_assoc($result_report);
    $total_report = $row_report['total'];
} else {
    $total_report = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Dashboard</title>
    <link rel="stylesheet" href="/wetrack/Lapas/css/style.css">
    <script src="/wetrack/Lapas/js/script.js"></script>
    <link rel="icon" href="/wetrack/Lapas/Image/wetrack-logo-white.png" type="Image/x-icon">
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
            .user-profile, .path-profile {
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
                    <li class="active"><a href="/wetrack/Lapas/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/data.php"><i class="fas fa-database"></i> <span>Prisoner Database</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/Laporan.php"><i class="fas fa-file-invoice"></i> <span>Prisoner Final Report</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
            <a href="/wetrack/lapas/pages/profile.php" style="text-decoration: none; color: inherit; margin-top: 120%;" class="path-profile">
                <div class="user-profile">
                    <img src="/wetrack/Lapas/Image/lapas-logo.png" alt="Profile picture" width="40" height="40">
                    <div class="user-info">
                        <h2>Serdy Fambo</h2>
                        <p>Administrative Staff</p>
                    </div>
                </div>
            </a>
        </aside>
        <main class="content">
            <div class="dashboard-grid">
                <section class="card summary-card">
                    <h3><i class="fas fa-users"></i>Total Prisoner Registered</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $total; ?></span>
                    </div>
                </section>
                <section class="card alert-card">
                    <h3><i class="fas fa-file-invoice"></i>Total Prisoner Final Report</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $total_report; ?></span>
                    </div>
                </section>
                <section class="card activity-card">
                    <h3><i class="fas fa-history"></i>Recent Activities</h3>
                    <ul class="activity-list">
                        <?php
                        // Fetch recent activities from the database
                        $activity_query = "SELECT action_type, action_description, created_at FROM recent_activities ORDER BY created_at DESC LIMIT 5";
                        $activity_result = mysqli_query($conn, $activity_query);

                        while ($activity = mysqli_fetch_assoc($activity_result)) {
                            echo "<li>";
                            echo "<span class='time'>" . date('H:i', strtotime($activity['created_at'])) . "</span>";
                            echo "<span class='activity'>" . htmlspecialchars($activity['action_description']) . "</span>";
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </section>
            </div>
        </main>
    </div>

</body>

</html>