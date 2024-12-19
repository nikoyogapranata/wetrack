<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK</title>
    <link rel="stylesheet" href="/wetrack/kemenhumkam/css/style.css">
    <script src="/wetrack/kemenhumkam/js/script.js"></script>
    <link rel="icon" href="/wetrack/kemenhumkam/Images/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="/wetrack/kemenhumkam/Images/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li class="active"><a href="/wetrack/kemenhumkam/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/kemenhumkam/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
                    <li><a href="/wetrack/kemenhumkam/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
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
            </div>
        </main>
    </div>
</body>

</html>