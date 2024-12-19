<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Admin POLRI</title>
  <link rel="stylesheet" href="http://localhost/wetrack/polri/css/styles.css">
</head>
<body>
  <div class="sidebar">
    <h2>Admin POLRI</h2>
    <ul>
      <li><a href="http://localhost/wetrack/polri/pages/index.php" style="color: inherit; text-decoration: none;">Dashboard</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/alerts.php" style="color: inherit; text-decoration: none;">Alerts</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/penanganan.php" style="color: inherit; text-decoration: none;">Penanganan</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/database.php" style="color: inherit; text-decoration: none;">Database</a></li>
      <li class="active"><a href="http://localhost/wetrack/polri/pages/profiles.php" style="color: inherit; text-decoration: none;">Profile</a></li>
      <li><a href="http://localhost/wetrack/polri/pages/logout.php" style="color: inherit; text-decoration: none;">Log Out</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Profile - Admin POLRI</h1>
    <div class="profile-container">
      <div class="profile-header">
        <div class="profile-image">
          <img src="https://via.placeholder.com/150" alt="Admin Profile Picture" id="profile-img">
        </div>
        <div class="profile-info">
          <h2>Admin POLRI</h2>
          <p>Administrator</p>
        </div>
      </div>

      <div class="profile-details">
        <!-- Displaying Profile Information -->
        <div class="form-group">
          <label for="full-name">Full Name:</label>
          <p id="full-name">Admin POLRI</p>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <p id="email">admin@polri.go.id</p>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <p id="password">********</p> <!-- Show as asterisks or blank for privacy -->
        </div>
      </div>
    </div>
  </div>

  <script src="http://localhost/wetrack/polri/js/profiles.js"></script>
</body>
</html>
