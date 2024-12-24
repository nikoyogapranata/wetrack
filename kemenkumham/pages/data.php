<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Use an absolute path based on the server's document root
require __DIR__ . '/../../config/connection.php';  // Corrected path

$user_id = $_SESSION['user_id'];
// Fetch user information
$user_id = $_SESSION['user_id'];
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

// Function to fetch users by role
function fetchUsersByRole($conn, $role, $search = '')
{
    $query = "SELECT id, nip, full_name FROM users WHERE role = ?";
    $params = [$role];
    $types = "s";

    if ($search) {
        $query .= " AND (id LIKE ? OR nip LIKE ? OR full_name LIKE ?)";
        $searchParam = "%$search%";
        $params = array_merge($params, [$searchParam, $searchParam, $searchParam]);
        $types .= "sss";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get search term if any
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch users for each role
$kemenkumhamUsers = fetchUsersByRole($conn, 'Kemenkumham', $search);
$lapasUsers = fetchUsersByRole($conn, 'Lapas', $search);
$bapasUsers = fetchUsersByRole($conn, 'Bapas', $search);
$polriUsers = fetchUsersByRole($conn, 'Polri', $search);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Database</title>
    <link rel="icon" href="/wetrack/kemenkumham/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/data.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .table-section {
            margin-bottom: 2rem;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-wrapper {
            max-height: 300px;
            /* Scroll height for the table */
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-container {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .search-container input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-container button {
            padding: 0.5rem 1rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th,
        .user-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background: #f5f5f5;
            font-weight: 600;
        }


        .btn-details {
            padding: 0.25rem 0.75rem;
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-details:hover {
            background: var(--primary-color);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar remains the same -->
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
                    <li class="active"><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
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
            <div class="content-container">
                <div class="content-header">
                    <h1>User Database</h1>
                    <form class="search-container" method="GET">
                        <input type="text" name="search" placeholder="Search by ID, NIP, or Name..."
                            value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <!-- Kemenkumham Users -->
                <section class="table-section">
                    <h2>Kemenkumham</h2>
                    <form class="search-container" method="GET">
                        <input type="text" name="search" placeholder="Search in Kemenkumham..."
                            value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Search</button>
                    </form>
                    <div class="table-wrapper">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kemenkumhamUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['nip'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($user['full_name'] ?? '-'); ?></td>
                                        <td>
                                            <a href="user-details.php?id=<?php echo $user['id']; ?>"
                                                class="btn-details">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Lapas Users -->
                <section class="table-section">
                    <h2>Lapas</h2>
                    <form class="search-container" method="GET">
                        <input type="text" name="search" placeholder="Search in Lapas..."
                            value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Search</button>
                    </form>
                    <div class="table-wrapper">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lapasUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['nip'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($user['full_name'] ?? '-'); ?></td>
                                        <td>
                                            <a href="user-details.php?id=<?php echo $user['id']; ?>"
                                                class="btn-details">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Bapas Users -->
                <section class="table-section">
                    <h2>Bapas</h2>
                    <form class="search-container" method="GET">
                        <input type="text" name="search" placeholder="Search in Bapas..."
                            value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Search</button>
                    </form>
                    <div class="table-wrapper">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bapasUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['nip'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($user['full_name'] ?? '-'); ?></td>
                                        <td>
                                            <a href="user-details.php?id=<?php echo $user['id']; ?>"
                                                class="btn-details">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Polri Users -->
                <section class="table-section">
                    <h2>Polri</h2>
                    <form class="search-container" method="GET">
                        <input type="text" name="search" placeholder="Search in Polri..."
                            value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Search</button>
                    </form>
                    <div class="table-wrapper">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($polriUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['nip'] ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($user['full_name'] ?? '-'); ?></td>
                                        <td>
                                            <a href="user-details.php?id=<?php echo $user['id']; ?>"
                                                class="btn-details">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </main>
    </div>
</body>

</html>