<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Use an absolute path based on the server's document root
require __DIR__ . '/../../config/connection.php';  // Corrected path

// Check if user is logged in
$user_id = $_SESSION['user_id'];

$edit_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$edit_id) {
    header('Location: data.php');
    exit();
}

// Fetch user details
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $edit_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: data.php');
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $nip = htmlspecialchars($_POST['nip'] ?? '');
    $full_name = htmlspecialchars($_POST['full_name'] ?? '');
    $place_of_birth = htmlspecialchars($_POST['place_of_birth'] ?? '');
    $date_of_birth = htmlspecialchars($_POST['date_of_birth'] ?? '');
    $religion = htmlspecialchars($_POST['religion'] ?? '');
    $region = htmlspecialchars($_POST['region'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $position = htmlspecialchars($_POST['position'] ?? '');
    $status = htmlspecialchars($_POST['status'] ?? '');

    // Handle file upload if new picture is provided
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
        $file_name = uniqid() . '.' . $file_ext;
        $upload_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
            $profile_picture = '/wetrack/kemenkumham/pages/uploads/' . $file_name;
            
            // Update query with new profile picture
            $stmt = $conn->prepare("UPDATE users SET profile_picture = ?, nip = ?, full_name = ?, 
                place_of_birth = ?, date_of_birth = ?, religion = ?, region = ?, email = ?, 
                phone = ?, position = ?, status = ? WHERE id = ?");
            $stmt->bind_param('sssssssssssi', 
                $profile_picture, $nip, $full_name, $place_of_birth, $date_of_birth,
                $religion, $region, $email, $phone, $position, $status, $edit_id);
        }
    } else {
        // Update query without profile picture
        $stmt = $conn->prepare("UPDATE users SET nip = ?, full_name = ?, place_of_birth = ?, 
            date_of_birth = ?, religion = ?, region = ?, email = ?, phone = ?, 
            position = ?, status = ? WHERE id = ?");
        $stmt->bind_param('ssssssssssi', 
            $nip, $full_name, $place_of_birth, $date_of_birth,
            $religion, $region, $email, $phone, $position, $status, $edit_id);
    }

    if ($stmt->execute()) {
        $message = "Profile updated successfully!";
        // Refresh user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}
$query = "SELECT id, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

// Set a default profile picture if none is set
if (!$profile_picture) {
    $profile_picture = '/wetrack/kemenkumham/Image/kemenkumham.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - WETRACK</title>
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/data.css">
    <style>
        .edit-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .edit-form h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #666;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .action-buttons {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }

        .btn-save {
            padding: 0.5rem 1rem;
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-cancel {
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
        <!-- Sidebar remains the same -->
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
                    <li><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i> <span>Database</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/create-account.php"><i class="fas fa-user-plus"></i> <span>Create Account</span></a></li>
                    <li><a href="/wetrack/kemenkumham/pages/setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
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
            <div class="content-container">
                <div class="edit-form">
                    <h2>Edit User Profile</h2>
                    <?php if ($message): ?>
                        <div class="message"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" value="<?php echo htmlspecialchars($user['id']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" 
                                       value="<?php echo htmlspecialchars($user['nip']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" id="full_name" name="full_name" 
                                       value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="place_of_birth">Place of Birth</label>
                                <input type="text" id="place_of_birth" name="place_of_birth" 
                                       value="<?php echo htmlspecialchars($user['place_of_birth']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" 
                                       value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <select name="religion" id="religion">
                                    <?php
                                    $religions = ['Islam', 'Christianity', 'Catholicism', 'Hinduism', 'Buddhism', 'Confucianism'];
                                    foreach ($religions as $religion) {
                                        $selected = ($user['religion'] === $religion) ? 'selected' : '';
                                        echo "<option value=\"$religion\" $selected>$religion</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input type="text" id="region" name="region" 
                                       value="<?php echo htmlspecialchars($user['region']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" 
                                       value="<?php echo htmlspecialchars($user['phone']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" id="position" name="position" 
                                       value="<?php echo htmlspecialchars($user['position']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status">
                                    <option value="Active" <?php echo $user['status'] === 'Active' ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo $user['status'] === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn-save">Save Changes</button>
                            <a href="user-details.php?id=<?php echo $user['id']; ?>" class="btn-cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>