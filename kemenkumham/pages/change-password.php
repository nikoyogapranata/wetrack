<?php
// Include database connection
include('connect.php'); // Adjust the path as needed

session_start();
$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the input
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $query = "SELECT password FROM kemenkumham_users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_password);
    $stmt->fetch();
    $stmt->close();

    // Verify if the old password matches the current one in the database
    if (password_verify($old_password, $current_password)) {
        // Check if the new password and confirm password match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $query = "UPDATE kemenkumham_users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $hashed_password, $user_id);

            if ($stmt->execute()) {
                $message = "Password updated successfully!";
            } else {
                $message = "Error updating password. Please try again.";
            }
            $stmt->close();
        } else {
            $message = "New password and confirm password do not match.";
        }
    } else {
        $message = "Old password is incorrect.";
    }
}

// Fetch the profile picture for the user
$query = "SELECT id, profile_picture FROM kemenkumham_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

// Set a default profile picture if none is set
if (!$profile_picture) {
    $profile_picture = '/wetrack/kemenkumham/Image/default-profile.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Profile</title>
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/style.css">
    <link rel="icon" href="/wetrack/kemenkumham/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/setting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/profile.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/wetrack/kemenkumham/js/script.js"></script>
    <style>.profile-container {
        max-width: 50%;
        margin: 2rem auto;
        padding: 2rem;
        background-color: var(--card-color);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      .profile-container h1 {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
      }

      .path-to-back {
        margin-bottom: 1rem;
      }

      .path-to-back a {
        text-decoration: none;
        color: var(--primary-color);
        font-size: 1.2rem;
      }

      .path-to-back a i {
        margin-right: 0.5rem;
      }

      .change-password-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
      }

      .form-group {
        display: flex;
        flex-direction: column;
      }

      .form-group label {
        font-size: 1rem;
        margin-bottom: 0.5rem;
        color: var(--text-color);
      }

      .form-group input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        color: var(--text-color);
      }

      .form-group input:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 4px var(--secondary-color);
      }

      .form-group button {
        padding: 0.75rem;
        background-color: var(--secondary-color);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .form-group button:hover {
        background-color: var(--accent-color);
      }

      .message {
        color: red;
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
                    <li><a href="/wetrack/kemenkumham/pages/home.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
                    <li class="active"><a href="/wetrack/kemenkumham/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="<?php echo $profile_picture; ?>" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2><?php echo htmlspecialchars($id); ?></h2> <!-- Dynamically displays the user ID -->
                    <p>Administrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">

        <div class="profile-container">
    <div class="path-to-back">
        <a href="/wetrack/kemenkumham/pages/profile.php"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Change Password</h1>

    <form action="change-password.php" method="POST" class="change-password-form">
        <!-- Old Password -->
        <div class="form-group">
            <label for="old-password">Old Password</label>
            <input type="password" id="old-password" name="old_password" placeholder="Enter your old password" required>
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new_password" placeholder="Enter your new password" required>
        </div>

        <!-- Confirm New Password -->
        <div class="form-group">
            <label for="confirm-password">Confirm New Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your new password" required>
        </div>

        <!-- Display message if available -->
        <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn">Save Changes</button>
        </div>
    </form>
</div>

        </main>
    </div>
</body>

</html>
