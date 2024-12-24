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

// Count total accounts for each role
$roles_query = "SELECT role, COUNT(*) as total FROM users WHERE role IN ('Lapas', 'Bapas', 'Polri') GROUP BY role";
$roles_result = $conn->query($roles_query);
$totals = [
    'Lapas' => 0,
    'Bapas' => 0,
    'Polri' => 0
];
while ($row = $roles_result->fetch_assoc()) {
    $totals[$row['role']] = $row['total'];
}

// Function to fetch login history by role
function getLoginHistory($conn, $role_prefix, $search = '')
{
    $query = "SELECT l.user_id, l.login_time, l.ip_address
              FROM login_history l
              JOIN users u ON l.user_id = u.id
              WHERE u.id LIKE ? ";

    if ($search) {
        $query .= "AND (l.user_id LIKE ? OR u.full_name LIKE ?)";
    }

    $query .= "ORDER BY l.login_time";

    $stmt = $conn->prepare($query);

    $pattern = $role_prefix . '%';
    if ($search) {
        $search_pattern = '%' . $search . '%';
        $stmt->bind_param('sss', $pattern, $search_pattern, $search_pattern);
    } else {
        $stmt->bind_param('s', $pattern);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get search terms if any
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch login history for each role
$kemenkumham_history = getLoginHistory($conn, '10', $search);
$lapas_history = getLoginHistory($conn, '11', $search);
$bapas_history = getLoginHistory($conn, '12', $search);
$polri_history = getLoginHistory($conn, '13', $search);

// Fetch recent activities
$activity_query = "SELECT action_type, action_description, created_at 
                  FROM recent_activities ";

if (isset($_GET['activity_search']) && !empty($_GET['activity_search'])) {
    $search = '%' . $_GET['activity_search'] . '%';
    $activity_query .= "WHERE action_description LIKE ? ";
}

$activity_query .= "ORDER BY created_at DESC LIMIT 10";

$stmt = $conn->prepare($activity_query);

if (isset($_GET['activity_search']) && !empty($_GET['activity_search'])) {
    $stmt->bind_param('s', $search);
}

$stmt->execute();
$activity_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK</title>
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/style.css">
    <script src="/wetrack/kemenkumham/js/script.js"></script>
    <link rel="icon" href="/wetrack/kemenkumham/Images/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap"
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
        }
        .history-section {
            margin-bottom: 2rem;
        }

        .history-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }



        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        .summary-card {
            text-align: center;
        }

        .summary-card h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .summary-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2563eb;
        }

        .login-history-wrapper {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
        }

        .login-history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .login-history-table th {
            position: sticky;
            top: 0;
            background: #f8fafc;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            font-weight: 600;
            color: #4b5563;
        }

        .login-history-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
        }

        .login-history-table tr:hover td {
            background: #f1f5f9;
        }

        .recent-activities-container {
            margin-top: 3vh;
        }

        .search-container {
            margin: 1rem 0;
            display: flex;
            gap: 0.5rem;
        }

        .search-container input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .search-container button {
            padding: 0.5rem 1rem;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: background-color 0.2s;
        }

        .search-container button:hover {
            background: #1d4ed8;
        }

        .activity-list li {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .activity-list li:last-child {
            border-bottom: none;
        }

        .time {
            color: #6b7280;
            font-size: 0.875rem;
            min-width: 50px;
        }

        .activity {
            color: #374151;
        }

        .activity-list strong {
            color: #2563eb;
        }
    </style>
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
                    <li class="active"><a href="/wetrack/kemenkumham/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/create-account.php"><i class="fas fa-user-plus"></i> <span>Create Account</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
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
                    <h3><i class="fas fa-building"></i>Total Lapas Accounts</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $totals['Lapas']; ?></span>
                    </div>
                </section>
                <section class="card summary-card">
                    <h3><i class="fas fa-users"></i>Total Bapas Accounts</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $totals['Bapas']; ?></span>
                    </div>
                </section>
                <section class="card summary-card">
                    <h3><i class="fas fa-shield-alt"></i>Total Polri Accounts</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $totals['Polri']; ?></span>
                    </div>
                </section>
            </div>

            <div class="history-grid">

                <!-- Lapas Login History -->
                <section class="card">
                    <h3><i class="fas fa-sign-in-alt"></i> Lapas Login History</h3>
                    <div class="search-container">
                        <input type="text" id="lapasSearch" placeholder="Search by User ID">
                        <button onclick="searchHistory('lapas')">Search</button>
                    </div>
                    <div class="login-history-wrapper">
                        <table class="login-history-table" id="lapas-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Login Time</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lapas_history as $login): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($login['user_id']); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', strtotime($login['login_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($login['ip_address']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Bapas Login History -->
                <section class="card">
                    <h3><i class="fas fa-sign-in-alt"></i> Bapas Login History</h3>
                    <div class="search-container">
                        <input type="text" id="bapasSearch" placeholder="Search by User ID">
                        <button onclick="searchHistory('bapas')">Search</button>
                    </div>
                    <div class="login-history-wrapper">
                        <table class="login-history-table" id="bapas-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Login Time</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bapas_history as $login): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($login['user_id']); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', strtotime($login['login_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($login['ip_address']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Polri Login History -->
                <section class="card">
                    <h3><i class="fas fa-sign-in-alt"></i> Polri Login History</h3>
                    <div class="search-container">
                        <input type="text" id="polriSearch" placeholder="Search by User ID">
                        <button onclick="searchHistory('polri')">Search</button>
                    </div>
                    <div class="login-history-wrapper">
                        <table class="login-history-table" id="polri-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Login Time</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($polri_history as $login): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($login['user_id']); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', strtotime($login['login_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($login['ip_address']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Kemenkumham Login History -->
                <section class="card">
                    <h3><i class="fas fa-sign-in-alt"></i> Kemenkumham Login History</h3>
                    <div class="search-container">
                        <input type="text" id="kemenkumhamSearch" placeholder="Search by User ID">
                        <button onclick="searchHistory('kemenkumham')">Search</button>
                    </div>
                    <div class="login-history-wrapper">
                        <table class="login-history-table" id="kemenkumham-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Login Time</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kemenkumham_history as $login): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($login['user_id']); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', strtotime($login['login_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($login['ip_address']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="recent-activities-container">
                <!-- Recent Activities -->
            <section class="card">
                    <h3><i class="fas fa-history"></i> Recent Activities</h3>
                    <div class="search-container">
                        <input type="text" id="activitySearch" placeholder="Search by Name">
                        <button type="button" onclick="searchActivities()">Search</button>
                    </div>
                    <div class="login-history-wrapper">
                        <table class="login-history-table" id="activity-table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($activity = $activity_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($activity['created_at']); ?></td>
                                        <td><?php echo htmlspecialchars($activity['action_description']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            

                
        </main>
    </div>

    <script>
        function searchHistory(role) {
            const searchInput = document.getElementById(role + 'Search').value;
            window.location.href = `?role=${role}&search=${encodeURIComponent(searchInput)}`;
        }

        function searchActivities() {
            const searchInput = document.getElementById('activitySearch').value;
            window.location.href = `?activity_search=${encodeURIComponent(searchInput)}`;
        }

        // Add event listeners for enter key
        document.querySelectorAll('.search-container input').forEach(input => {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    if (input.id === 'activitySearch') {
                        searchActivities();
                    } else {
                        searchHistory(input.id.replace('Search', ''));
                    }
                }
            });
        });
    </script>
</body>

</html>