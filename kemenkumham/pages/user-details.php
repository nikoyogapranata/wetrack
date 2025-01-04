<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Use an absolute path based on the server's document root
require __DIR__ . '/../../config/connection.php';  // Corrected path

// Check if user is logged in
$user_id = $_SESSION['user_id'];

// Get user ID from URL
$detail_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$detail_id) {
  header('Location: data.php');
  exit();
}

// Fetch user details
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $detail_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
  header('Location: data.php');
  exit();
}

// Set default profile picture if none is available
$profile_picture = isset($user['profile_picture']) && $user['profile_picture'] ? $user['profile_picture'] : '/wetrack/kemenkumham/Image/kemenkumham.png';

// Handle delete request
if (isset($_POST['delete'])) {
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $detail_id);
  if ($stmt->execute()) {
    header('Location: data.php');
    exit();
  }
}

$query = "SELECT id, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

// Use a default profile picture if none is set
if (!$profile_picture) {
  $profile_picture = '/wetrack/kemenkumham/Image/kemenkumham.png';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WETRACK</title>
  <link rel="stylesheet" href="/wetrack/kemenkumham/css/style.css">
  <link rel="icon" href="/wetrack/kemenkumham/Image/wetrack-logo-white.png" type="Image/x-icon">
  <link rel="stylesheet" href="/wetrack/kemenkumham/css/setting.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
    rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="/wetrack/kemenkumham/js/script.js"></script>
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
        }
    .user-details {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .user-details h2 {
      margin-bottom: 1.5rem;
      color: #333;
    }

    .profile-container {
      text-align: left;
      margin-bottom: 2rem;
    }

    .profile-container img {
      border-radius: 50%;
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
    }

    .detail-item {
      margin-bottom: 1rem;
    }

    .detail-item label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #666;
    }

    .detail-item p {
      margin: 0;
      color: #333;
    }

    .action-buttons {
      margin-top: 2rem;
      display: flex;
      gap: 1rem;
    }

    .btn-edit {
      padding: 0.5rem 1rem;
      background: var(--secondary-color);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-delete {
      padding: 0.5rem 1rem;
      background: #dc3545;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      height: 100%;
      font-size: 16px;
    }

    .btn-back {
      padding: 0.5rem 1rem;
      background: #6c757d;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <div class="logo">
          <img src="/wetrack/kemenkumham/Image/wetrack-logo-white.png" alt="WETRACK Logo">
          <h1 class="logo-text">WETRACK</h1>
        </div>
        <button id="toggle-sidebar" class="toggle-sidebar">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <nav class="nav-links">
        <ul>
          <li class="active"><a href="/wetrack/kemenkumham/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
          <li><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i> <span>User Database</span></a></li>
          <li><a href="/wetrack/kemenkumham/pages/create-account.php"><i class="fas fa-user-plus"></i> <span>Create Account</span></a></li>
          <li><a href="/wetrack/kemenkumham/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
        </ul>
      </nav>
      <div class="user-profile">
        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile picture" width="40" height="40">
        <div class="user-info">
          <h2><?php echo htmlspecialchars($id); ?></h2>
          <p>Administrative Staff</p>
        </div>
      </div>
    </aside>

    <main class="content">
      <div class="content-container">
        <div class="user-details">
          <div class="back-arrow-container">
            <a href="data.php" class="back-arrow">
              <i class="fas fa-arrow-left"></i>
            </a>
          </div>

          <h2>User Details</h2>

          <!-- Profile Picture Section -->
          <div class="profile-container">
            <div class="detail-item">
              <label>Profile Picture</label>
              <p>
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="100" height="100">
              </p>
            </div>
          </div>

          <div class="detail-grid">
            <div class="detail-item">
              <label>ID</label>
              <p><?php echo htmlspecialchars($user['id']); ?></p>
            </div>
            <div class="detail-item">
              <label>NIP</label>
              <p><?php echo htmlspecialchars($user['nip'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Full Name</label>
              <p><?php echo htmlspecialchars($user['full_name'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Place of Birth</label>
              <p><?php echo htmlspecialchars($user['place_of_birth'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Date of Birth</label>
              <p><?php echo htmlspecialchars($user['date_of_birth'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Religion</label>
              <p><?php echo htmlspecialchars($user['religion'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Region</label>
              <p><?php echo htmlspecialchars($user['region'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Role</label>
              <p><?php echo htmlspecialchars($user['role'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Email</label>
              <p><?php echo htmlspecialchars($user['email'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Phone</label>
              <p><?php echo htmlspecialchars($user['phone'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Position</label>
              <p><?php echo htmlspecialchars($user['position'] ?? '-'); ?></p>
            </div>
            <div class="detail-item">
              <label>Status</label>
              <p><?php echo htmlspecialchars($user['status'] ?? '-'); ?></p>
            </div>
          </div>

          <div class="action-buttons">
            <a href="edit-user.php?id=<?php echo $user['id']; ?>" class="btn-edit">Edit Profile</a>
            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
              <button type="submit" name="delete" class="btn-delete">Delete Profile</button>
            </form>
            <a href="data.php" class="btn-back">Back to List</a>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>

</html>