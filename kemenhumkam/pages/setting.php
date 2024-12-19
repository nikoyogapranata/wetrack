<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Settings</title>
    <link rel="stylesheet" href="/wetrack/kemenhumkam/css/style.css">
    <link rel="icon" href="/wetrack/kemenhumkam/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/kemenhumkam/css/setting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/wetrack/kemenhumkam/js/script.js"></script>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="/wetrack/kemenhumkam/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/kemenhumkam/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/kemenhumkam/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
                    <li class="active"><a href="/wetrack/kemenhumkam/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="/wetrack/kemenhumkam/Image/kemenhumkam-logo.png" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2>Serdy Fambo</h2>
                    <p>kemenhumkamistrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">
            <div class="settings-container">
                <h1>Settings</h1>
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
                <button id="logout-btn" class="btn btn-danger">Log Out</button>
            </div>
        </main>
    </div>
</body>

</html>
