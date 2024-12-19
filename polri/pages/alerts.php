<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POLRI Admin Alerts</title>
  <link rel="stylesheet" href="/polri/css/styles.css">
  <link rel="stylesheet" href="http://localhost/wetrack/polri/css/styles.css">
  <link rel="stylesheet" href="/polri/css/styles.css">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin POLRI</h2>
    <ul>
      <li><a href="http://localhost/wetrack/polri/pages/index.php" style="color: inherit; text-decoration: none;">Dashboard</a></li>
      <li class="active"><a href="http://localhost/wetrack/polri/pages/alerts.php" style="color: inherit; text-decoration: none;">Alert</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/penanganan.php" style="color: inherit; text-decoration: none;">Penanganan</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/database.php" style="color: inherit; text-decoration: none;">Database</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/profiles.php" style="color: inherit; text-decoration: none;">Profile</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/logout.php" style="color: inherit; text-decoration: none;">Log Out</a></li>
    </ul>
  </div> 

  <!-- Main Content -->
  <div class="main-content">
    <div class="header">
      <h1>Active Alerts</h1>
    </div>

    <!-- Alert Table -->
    <div class="alerts-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Report</th>
            <th>Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="alertTableBody">
          <!-- Data Rows Will be Rendered Here by JS -->
        </tbody>
      </table>
    </div>
  </div>
  <script src="/polri/js/alerts.js"></script>
  <script src="http://localhost/wetrack/polri/js/alerts.js"></script>
  <script src="/polri/js/alerts.js"></script>
</body>
</html>
