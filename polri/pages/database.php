<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database</title>
  <link rel="stylesheet" href="/frontend/pages/polri/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin POLRI</h2>
        <ul>
          <li><a href="/frontend/pages/polri/html/index.html" style="color: inherit; text-decoration: none;">Dashboard</a></li>
          <li><a href="/frontend/pages/polri/html/alerts.html" style="color: inherit; text-decoration: none;">Alerts</a></li>
          <li><a href="/frontend/pages/polri/html/penanganan.html" style="color: inherit; text-decoration: none;">Penanganan</a></li>
          <li class="active"><a href="/frontend/pages/polri/html/database.html" style="color: inherit; text-decoration: none;">Database</a></li>
          <li><a href="/frontend/pages/polri/html/profiles.html" style="color: inherit; text-decoration: none;">Profile</a></li>
          <li><a href="/frontend/pages/polri/html/logout.html" style="color: inherit; text-decoration: none;">Log Out</a></li>
        </ul>
      </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Database</h1>
    <div class="database-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Budi Santoso</td>
            <td>Jl. Merdeka No. 12</td>
            <td>08123456789</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Siti Rahma</td>
            <td>Jl. Pahlawan No. 5</td>
            <td>08234567890</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="/frontend/pages/polri/js/database.js"></script>
</body>
</html>