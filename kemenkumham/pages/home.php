<?php
// Include database connection
include('connect.php'); // Adjust the path as needed

// Assuming you have a session that holds the user ID (e.g., from login)
session_start();
$user_id = $_SESSION['user_id']; // Or any method you're using to store the logged-in user ID

// Fetch user information from the database
$query = "SELECT id, profile_picture FROM kemenkumham_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

// Fetch login history for all users
$query = "SELECT u.id AS user_id, l.login_time, l.ip_address 
          FROM login_history l
          JOIN kemenkumham_users u ON l.user_id = u.id
          ORDER BY l.login_time DESC LIMIT 10"; // Adjust the limit as needed
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($login_user_id, $login_time, $ip_address);

$login_history = [];
while ($stmt->fetch()) {
    $login_history[] = [
        'user_id' => $login_user_id, 
        'login_time' => $login_time, 
        'ip_address' => $ip_address
    ];
}
$stmt->close();

// Set a default profile picture if none is set
if (!$profile_picture) {
    $profile_picture = '/wetrack/kemenkumham/Image/default-profile.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
    <style>.dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3vh;
}   </style>
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
            <?php
            // Static data for demonstration
            $totalLapasAccounts = 25;
            $totalBapasAccounts = 18;
            $totalPolriAccounts = 32;

            $activities = [
                ['time' => '09:45', 'activity' => 'New Lapas account added'],
                ['time' => '08:30', 'activity' => 'Bapas account updated'],
                ['time' => '07:15', 'activity' => 'New Polri account created'],
                ['time' => 'Yesterday', 'activity' => 'Monthly account report generated'],
                ['time' => '2 days ago', 'activity' => 'System maintenance completed'],
            ];
            ?>
            <div class="dashboard-grid">
                <section class="card summary-card">
                    <h3><i class="fas fa-building"></i>Total Lapas Accounts</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $totalLapasAccounts; ?></span>
                    </div>
                    <p class="trend positive">+5% from last month</p>
                </section>
                <section class="card summary-card">
                    <h3><i class="fas fa-users"></i>Total Bapas Accounts</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $totalBapasAccounts; ?></span>
                    </div>
                    <p class="trend positive">+2% from last month</p>
                </section>
                <section class="card summary-card">
                    <h3><i class="fas fa-shield-alt"></i>Total Polri Accounts</h3>
                    <div class="card-content">
                        <span class="number"><?php echo $totalPolriAccounts; ?></span>
                    </div>
                    <p class="trend negative">-1% from last month</p>
                </section>
                
            </div>
            <div class="dashboard-grid">
            <section class="card activity-card">
                    <h3><i class="fas fa-history"></i>Recent Activities</h3>
                    <ul class="activity-list">
                        <?php foreach ($activities as $activity): ?>
                            <li>
                                <span class="time"><?php echo $activity['time']; ?></span>
                                <span class="activity"><?php echo $activity['activity']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>

                <!-- Login History -->
                <section class="card login-history-card">
                    <h3><i class="fas fa-sign-in-alt"></i> Recent Logins</h3>
                    <table class="login-history-table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Login Time</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($login_history as $login): ?>
                                <?php 
                                    // Format the login time
                                    $formatted_time = date('Y-m-d H:i:s', strtotime($login['login_time']));
                                    // Format the IP address (example: replace local IP with "Localhost")
                                    $formatted_ip = ($login['ip_address'] === '127.0.0.1') ? 'Localhost' : $login['ip_address'];
                                ?>
                                <tr>
                                    <td><?php echo $login['user_id']; ?></td>
                                    <td><?php echo $formatted_time; ?></td>
                                    <td><?php echo $formatted_ip; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>

</html>
