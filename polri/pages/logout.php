<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout - Dashboard</title>
  <link rel="stylesheet" href="/polri/css/styles.css"> 
  <script src="/polri/js/logout.js"></script>
  <link rel="stylesheet" href="/wetrack/polri/css/styles.css"> 
  <script src="/wetrack/polri/js/logout.js"></script>
  <link rel="stylesheet" href="/polri/css/styles.css"> 
  <script src="/polri/js/logout.js"></script>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Dashboard</h2>
    <ul>
      <li><a href="/wetrack/polri/pages/index.php">Dashboard</a></li>
      <li><a href="/wetrack/polri/pages/alerts.php">Alerts</a></li>
      <li><a href="/wetrack/polri/pages/penanganan.php">Penanganan</a></li>
      <li><a href="/wetrack/polri/pages/profiles.php">Profile</a></li>
      <li class="active" onclick="logout()">Logout</li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Logout Page</h1>
    <p>Anda akan keluar dari sistem. Klik tombol di bawah untuk melanjutkan.</p>
    <button class="logout-btn" onclick="logout()">Logout</button>
  </div>
</body>
</html>
