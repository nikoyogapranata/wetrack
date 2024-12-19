<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POLRI Admin Dashboard</title>
  <link rel="stylesheet" href="http://localhost/wetrack/polri/css/styles.css">
  <!-- Tambahkan Chart.js Library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>Admin POLRI</h2>
        <ul>
          <li class="active"><a href="/polri/html/index.html" style="color: inherit; text-decoration: none;">Dashboard</a></li>
          <li><a href="/polri/html/alerts.html" style="color: inherit; text-decoration: none;">Alerts</a></li>
          <li><a href="/polri/html/penanganan.html" style="color: inherit; text-decoration: none;">Penanganan</a></li>
          <li><a href="/polri/html/database.html" style="color: inherit; text-decoration: none;">Database</a></li>
          <li><a href="/polri/html/profiles.html" style="color: inherit; text-decoration: none;">Profile</a></li>
          <li><a href="/polri/html/logout.html" style="color: inherit; text-decoration: none;">Log Out</a></li>
        </ul>
      </div>
      

  <!-- Main Dashboard -->
  <div class="main-content">
    <div class="header">
      <h1>Dashboard</h1>
      <input type="text" placeholder="Search...">
    </div>

    <!-- Cards -->
    <div class="cards">
      <div class="card">
        <h3>Total Tracked Individuals</h3>
        <h2>1,365</h2>
        <p class="green">+5% from last month</p>
      </div>
      <div class="card">
        <h3>Active Alerts</h3>
        <h2>7</h2>
        <p class="red">Requires immediate attention</p>
      </div>
      <div class="card">
        <h3>Successful Registrations</h3>
        <h2>152</h2>
        <p class="green">+12% this week</p>
      </div>
    </div>

    <!-- Grafik Section -->
    <div class="charts">
      <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <!-- Recent Activities -->
    <div class="recent-activities">
      <h3>Recent Activities</h3>
      <ul>
        <li><strong>09:45</strong> New registration added</li>
        <li><strong>08:30</strong> Alert triggered in Zone B</li>
        <li><strong>07:15</strong> System update completed</li>
        <li><strong>Yesterday</strong> Monthly report generated</li>
      </ul>
    </div>
  </div>

  <script src="/polri/js/scripts.js"></script>
</body>
</html>
