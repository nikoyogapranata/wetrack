<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penanganan Laporan</title>
  <link rel="stylesheet" href="/wetrack/polri/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin POLRI</h2>
        <ul>
          <li><a href="/wetrack/polri/pages/index.php" style="color: inherit; text-decoration: none;">Dashboard</a></li>
          <li><a href="/wetrack/polri/pages/alerts.php" style="color: inherit; text-decoration: none;">Alerts</a></li>
          <li class="active"><a href="/wetrack/polri/pages/penanganan.php" style="color: inherit; text-decoration: none;">Penanganan</a></li>
          <li><a href="/wetrack/polri/pages/database.php" style="color: inherit; text-decoration: none;">Database</a></li>
          <li><a href="/wetrack/polri/pages/profiles.php" style="color: inherit; text-decoration: none;">Profile</a></li>
          <li><a href="/wetrack/polri/pages/logout.php" style="color: inherit; text-decoration: none;">Log Out</a></li>
        </ul>
      </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Penanganan Laporan</h1>
    <div class="handling-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Pelapor</th>
            <th>Laporan</th>
            <th>Status</th>
            <th>Update Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Budi Santoso</td>
            <td>Perampokan di toko emas</td>
            <td><span class="status pending">Pending</span></td>
            <td>
              <button class="update-btn" onclick="updateStatus(this, 'Processed')">Processed</button>
              <button class="update-btn" onclick="updateStatus(this, 'Resolved')">Resolved</button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Siti Rahma</td>
            <td>Tabrak lari di Jalan Raya</td>
            <td><span class="status pending">Pending</span></td>
            <td>
              <button class="update-btn" onclick="updateStatus(this, 'Processed')">Processed</button>
              <button class="update-btn" onclick="updateStatus(this, 'Resolved')">Resolved</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="/wetrack/polri/js/penanganan.js"></script>
</body>
</html>
