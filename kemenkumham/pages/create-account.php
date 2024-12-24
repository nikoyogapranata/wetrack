<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Use an absolute path based on the server's document root
require __DIR__ . '/../../config/connection.php';  // Corrected path

// Check if user is logged in
$user_id = $_SESSION['user_id'];

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs using htmlspecialchars instead of FILTER_SANITIZE_STRING
    $role = htmlspecialchars($_POST['role'] ?? '');
    $nip = htmlspecialchars($_POST['nip'] ?? '');
    $full_name = htmlspecialchars($_POST['full_name'] ?? '');
    $gender = htmlspecialchars($_POST['gender'] ?? '');
    $place_of_birth = htmlspecialchars($_POST['place_of_birth'] ?? '');
    $date_of_birth = htmlspecialchars($_POST['date_of_birth'] ?? '');
    $religion = htmlspecialchars($_POST['religion'] ?? '');
    $region = htmlspecialchars($_POST['region'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');
    $position = htmlspecialchars($_POST['position'] ?? '');
    $password = $_POST['password']; // Will be hashed

    // Handle file upload
    $profile_picture = '/wetrack/kemenkumham/image/kemenkumham.png'; // Default image
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        // Change the upload directory to the new path
        $upload_dir = __DIR__ . '/../uploads/'; // Going up one level to access the new 'uploads' folder

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create uploads directory if it doesn't exist
        }

        $file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
        $file_name = uniqid() . '.' . $file_ext;
        $upload_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
            // Adjust the profile picture path to reflect the new upload directory
            $profile_picture = '/wetrack/kemenkumham/uploads/' . $file_name;
        }
    }

    $prefix = '';
    switch ($role) {
        case 'Lapas':
            $prefix = '11';
            break;
        case 'Bapas':
            $prefix = '12';
            break;
        case 'Polri':
            $prefix = '13';
            break;
        default:
            $message = "Invalid role selected";
            break;
    }

    if ($prefix) {
        // Get the last 6 digits from the latest ID with the same prefix
        $stmt = $conn->prepare("SELECT MAX(id) as max_id FROM users WHERE id LIKE ?");
        $like_pattern = $prefix . '%';
        $stmt->bind_param('s', $like_pattern);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['max_id']) {
            $last_number = intval(substr($row['max_id'], -6)) + 1;
        } else {
            $last_number = 1;
        }

        $new_id = intval($prefix . str_pad($last_number, 5, '0', STR_PAD_LEFT));

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (id, profile_picture, nip, full_name, place_of_birth, 
            date_of_birth, religion, region, role, email, phone, address, created_by, position, password, gender) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            'isssssssssssisss',
            $new_id,
            $profile_picture,
            $nip,
            $full_name,
            $place_of_birth,
            $date_of_birth,
            $religion,
            $region,
            $role,
            $email,
            $phone,
            $address,
            $_SESSION['user_id'],
            $position,
            $hashed_password,
            $gender
        );

        if ($stmt->execute()) {
            // Store success message in session
            $_SESSION['message'] = "Account created successfully with ID: " . $new_id;

            // Log the activity
            $action_description = "New $role account created: $full_name";
            $stmt = $conn->prepare("INSERT INTO recent_activities (action_type, action_description) VALUES ('account_creation', ?)");
            $stmt->bind_param('s', $action_description);
            $stmt->execute();

            // Redirect to the same page to avoid resubmission
            header('Location: create-account.php');
            exit; // Always call exit after header redirect
        } else {
            $message = "Error creating account: " . $conn->error;
        }
    }
}

// Fetch message from session if set
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Clear message after it has been displayed
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
    <title>Create Account - WETRACK</title>
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/style.css">
    <script src="/wetrack/kemenkumham/js/script.js"></script>
    <link rel="icon" href="/wetrack/kemenkumham/Images/wetrack-logo-white.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        /* Custom Styles */
        .form-container {
            max-width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            height: 100px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
        }

        .h2-create-account {
            font-size: 2rem;
            margin-bottom: 2rem;
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
                    <li class="active"><a href="/wetrack/kemenkumham/pages/create-account.php"><i class="fas fa-user-plus"></i> <span>Create Account</span></a></li>
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
            <div class="form-container">
                <h2 class="h2-create-account">Create New Account</h2>
                <?php if ($message): ?>
                    <div class="message"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" required>
                                <option value="">Select Role</option>
                                <option value="Lapas">Lapas</option>
                                <option value="Bapas">Bapas</option>
                                <option value="Polri">Polri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="place_of_birth">Place of Birth</label>
                            <input type="text" id="place_of_birth" name="place_of_birth" required>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="form-group">
                            <label for="religion">Religion</label>
                            <select name="religion" id="religion" required>
                                <option value="">Select Religion</option>
                                <option value="Islam">Islam</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Catholicism">Catholicism</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Confucianism">Confucianism</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <input type="text" id="region" name="region" required>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" id="position" name="position" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" id="profile_picture" name="profile_picture">
                        </div>
                        <div class="form-group full-width">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <button type="submit">Create Account</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>