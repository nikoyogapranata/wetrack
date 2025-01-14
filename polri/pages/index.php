<?php
session_start();
require __DIR__ . '/../../config/connection.php';  // Corrected path

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Validasi page yang diperbolehkan
$allowed_pages = ['dashboard', 'alerts', 'penanganan', 'database', 'profiles', 'logout'];
if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}
define('BASE_PATH', dirname(__FILE__));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLRI Admin System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/wetrack/polri/assets/css/styles.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery (diperlukan untuk beberapa fitur Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Burger Icon */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .burger-icon {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #fff;
            position: relative;
            transition: background-color 0.3s;
        }

        .burger-icon::before,
        .burger-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #fff;
            transition: all 0.3s;
        }

        .burger-icon::before {
            top: -8px;
        }

        .burger-icon::after {
            bottom: -8px;
        }

        /* Sidebar Toggle */
        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar.collapsed h2,
        .sidebar.collapsed ul li a span {
            display: none;
        }

        .main-content.expanded {
            margin-left: 60px;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
                position: absolute;
                top: 10px;
                left: 10px;
                z-index: 1000;
            }

            .sidebar {
                position: fixed;
                left: -240px;
                transition: left 0.3s ease;
            }

            .sidebar.collapsed {
                left: 0;
                width: 240px;
            }

            .main-content {
                margin-left: 0;
                transition: margin-left 0.3s ease;
            }

            .main-content.expanded {
                margin-left: 240px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <button id="sidebarToggle" class="sidebar-toggle">
            <span class="burger-icon"><i class="fas fa-bars"></i>
            </span>
        </button>
        <h2>Admin POLRI</h2>
        <ul>
            <li class="<?php echo ($page === 'dashboard') ? 'active' : ''; ?>">
                <a href="/wetrack/polri/pages/index.php?page=dashboard">Dashboard</a>
            </li>
            <li class="<?php echo ($page === 'alerts') ? 'active' : ''; ?>">
                <a href="/wetrack/polri/pages/index.php?page=alerts">Alerts</a>
            </li>
            <li class="<?php echo ($page === 'penanganan') ? 'active' : ''; ?>">
                <a href="/wetrack/polri/pages/index.php?page=penanganan">Penanganan</a>
            </li>
            <li class="<?php echo ($page === 'database') ? 'active' : ''; ?>">
                <a href="/wetrack/polri/pages/index.php?page=database">Database</a>
            </li>
            <li class="<?php echo ($page === 'profiles') ? 'active' : ''; ?>">
                <a href="/wetrack/polri/pages/index.php?page=profiles">Profile</a>
            </li>
            <li>
                <a href="/wetrack/public/landing-page/index.php">Log Out</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php
        $page_file = "content/{$page}.php";
        if (file_exists($page_file)) {
            include $page_file;
        } else {
            echo "<h1>Page not found</h1>";
        }
        ?>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <!-- Database Specific JS -->
    <?php if ($page === 'database'): ?>
        <script src="/wetrack/polri/assets/js/database.js"></script>
    <?php endif; ?>
    <!-- Alerts Specific JS -->
    <?php if ($page === 'alerts'): ?>
        <script src="/wetrack/polri/assets/js/alerts.js"></script>
    <?php endif; ?>
</body>

</html>