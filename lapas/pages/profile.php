<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Profile</title>
    <link rel="stylesheet" href="/wetrack/Lapas/css/style.css">
    <link rel="icon" href="/wetrack/Lapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/Lapas/css/setting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/wetrack/Lapas/css/profile.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/wetrack/Lapas/js/script.js"></script>
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
                    <img src="/wetrack/Lapas/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/Lapas/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/data.php"><i class="fas fa-database"></i> <span>Prisoner Database</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/Laporan.php"><i class="fas fa-file-invoice"></i> <span>Final Report</span></a></li>
                    <li class="active"><a href="/wetrack/Lapas/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
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

            <div class="profile-container">
                <div class="path-to-back">
                    <a href="/wetrack/Lapas/pages/setting.php"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Administrative Staff</h1>
                <img src="/wetrack/Lapas/Image/lapas-logo.png" alt="Photo Profile">
                <h2>Serdy Fambo</h2>
                <p>NIP. 06-30-21</p>

                <div class="profile-information">
                    <p>Place and date of birth: Ngawi, 29 February 1980</p>
                    <p>Religion: Atheis</p>
                    <p>Education:</p>
                    <nav>
                        <ul>
                            <li>Stanford University (1998)</li>
                            <li>Cendrawasih University (2007)</li>
                        </ul>
                    </nav>
                    <p>Job History:</p>
                    <nav>
                        <ul>
                            <li>Head of Administration and Public Order of Class IIB Cilacap Prison</li>
                            <li>Head of Class IIB Klungkung Prison</li>
                        </ul>
                    </nav>
                </div>
            </div>
    </div>
    </main>
    </div>
</body>

</html>