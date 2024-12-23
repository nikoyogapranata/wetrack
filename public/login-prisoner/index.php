<?php
session_start();
require_once '../../config/connection.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['id'];
    $nrt = $_POST['password'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['nik'] = $row['nik'];
        $_SESSION['nrt'] = $row['nrt'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['latitude'] = $latitude;
        $_SESSION['longitude'] = $longitude;

        // Update location in the database
        $update_stmt = $conn->prepare("UPDATE prisoner_geofence SET centerLat = ?, centerLng = ? WHERE nik = ? AND nrt = ?");
        $update_stmt->bind_param("ddss", $latitude, $longitude, $nik, $nrt);
        $update_stmt->execute();
        $update_stmt->close();

        // Check if this is the first login
        $check_login_stmt = $conn->prepare("SELECT first_login FROM prisoner_geofence WHERE nik = ? AND nrt = ?");
        $check_login_stmt->bind_param("ss", $nik, $nrt);
        $check_login_stmt->execute();
        $check_login_result = $check_login_stmt->get_result();
        $login_data = $check_login_result->fetch_assoc();

        if ($login_data['first_login'] === null) {
            // If it's the first login, update the first_login time
            $update_login_stmt = $conn->prepare("UPDATE prisoner_geofence SET first_login = NOW() WHERE nik = ? AND nrt = ?");
            $update_login_stmt->bind_param("ss", $nik, $nrt);
            $update_login_stmt->execute();
            $update_login_stmt->close();
        }

        $check_login_stmt->close();

        $_SESSION['has_logged_in'] = true;

        header("Location: /wetrack/monitored-individuals/pages/profile.php");
        exit();
    } else {
        $error_message = "Invalid NIK or NRT. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html data-wf-page="676108a2b3193f26b432b712" data-wf-site="676108a1b3193f26b432b6b5" data-wf-status="1">

<head>
  <meta charset="utf-8" />
  <title>Login - WETRACK Monitored Individual</title>
  <meta content="Login interface for WETRACK Monitored Individuals" name="description" />
  <meta content="Login - WETRACK Monitored Individual" property="og:title" />
  <meta content="Login interface for WETRACK Monitored Individuals" property="og:description" />
  <meta content="Login - WETRACK Monitored Individual" property="twitter:title" />
  <meta content="Login interface for WETRACK Monitored Individuals" property="twitter:description" />
  <meta property="og:type" content="website" />
  <meta content="summary_large_image" name="twitter:card" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link href="css/webflow-style.css" rel="stylesheet" type="text/css" />
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon" />
  <link href="images/app-icon.png" rel="apple-touch-icon" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
</head>

<body>
  <div class="page-wrapper">
    <div class="page-container _2">
      <div class="block-2">
        <div class="form-wrapper">
          <h2 class="heading-2">Login to WETRACK<br /></h2>
          <div class="form-box">
            <h3 class="heading-4">Please log in with your NIK and NRT to access your profile. Unauthorized use is strictly prohibited and monitored.</h3>
            <div class="div-block-6-copy"></div>
            <div class="w-form">
              <form id="login-form" method="post" action="">
                <div class="form-field-wrapper">
                  <div class="text-field-box _2">
                    <label for="id" class="field-label-2">NIK</label>
                    <input class="text-field-2 w-input" maxlength="256" name="id" placeholder="Enter your NIK" type="text" id="id" required />
                  </div>
                  <div class="text-field-box _2">
                    <label for="password" class="field-label-2">NRT (Password)</label>
                    <input class="text-field-2 w-input" maxlength="256" name="password" placeholder="Enter your NRT" type="password" id="password" required />
                  </div>
                </div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <input type="submit" class="button registration w-button" value="Login" />
              </form>
              <?php if (!empty($error_message)): ?>
                <div class="error-message">
                  <?php echo $error_message; ?>
                </div>
              <?php endif; ?>
              <div id="location-message" style="color: red;"></div>
            </div>
          </div>
        </div>
        <div class="legal-box _2-copy">
          <div class="legal-text _3">© 2024 WETRACK. All rights reserved.</div>
        </div>
      </div>
    </div>
    <div class="page-container">
      <div class="block-1">
        <div class="content-wrapper">
          <a href="/wetrack/public/landing-page/index.php" class="nav-footer-logo w-nav-brand">
            <img width="40" sizes="40px" alt="" src="images/logo-white.png" loading="lazy" srcset="images/logo-white-p-500.png 500w, images/logo-white-p-800.png 800w, images/logo-white-p-1080.png 1080w, images/logo-white-p-1600.png 1600w, images/logo-white-p-2000.png 2000w, images/logo-white.png 2160w" class="logo" />
            <div class="logo-text logo-text-footer">WETRACK</div>
          </a>
          <div class="content-box">
            <h1 class="heading-1">Welcome to the monitoring system. Log in to view your profile, curfew schedule, and final report.<br /></h1>
          </div>
          <div class="legal-box _2">
            <div class="legal-text">© 2024 WETRACK. All rights reserved.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/script.js" type="text/javascript"></script>
  <script src="js/location-tracking.js"></script>
</body>

</html>

