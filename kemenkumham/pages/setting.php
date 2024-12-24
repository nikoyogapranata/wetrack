<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Use an absolute path based on the server's document root
require __DIR__ . '/../../config/connection.php';  // Corrected path
$user_id = $_SESSION['user_id']; // Or any method you're using to store the logged-in user ID

// Fetch user information from the database
$query = "SELECT id, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

// Set a default profile picture if none is set
if (!$profile_picture) {
    $profile_picture = '/wetrack/kemenkumham/Image/kemenkumham.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Settings</title>
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/style.css">
    <link rel="icon" href="/wetrack/kemenkumham/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/setting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/wetrack/kemenkumham/js/script.js"></script>
    <style>  @media screen and (max-width: 1024px) {
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
                    <img src="/wetrack/kemenkumham/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/kemenkumham/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/create-account.php"><i class="fas fa-user-plus"></i> <span>Create Account</span></a></li>
                    <li class="active"><a href="/wetrack/kemenkumham/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
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
            <div class="settings-container">
                <h1>Settings</h1>
                <div class="setting-element">
                    <h2><i class="fas fa-user"></i>Profile</h2>
                    <a href="/wetrack/kemenkumham/pages/profile.php" class="element-button">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <hr>

                <div class="setting-element">
                    <h2><i class="fas fa-question-circle"></i>FAQ</h2>
                    <button class="element-button">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <hr>
                <div class="setting-element">
                    <h2><i class="fas fa-globe"></i>Language</h2>
                    <select name="language" id="language">
                        <option value="en">English</option>
                        <option value="id">Bahasa Indonesia</option>
                        <option value="vie">Vietnam</option>
                    </select>
                </div>
                <button id="logout-btn" class="btn btn-danger" onclick="window.location.href='/wetrack/kemenkumham/pages/logout.php'">Log Out</button>

            </div>
        </main>
    </div>
</body>

</html>
