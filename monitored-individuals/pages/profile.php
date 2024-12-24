<?php
session_start();
require_once '../../config/connection.php';

// Check if user is logged in
if (!isset($_SESSION['nik'])) {
    header("Location: /wetrack/public/login-prisoner/index.php");
    exit();
}

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ?");
$stmt->bind_param("s", $_SESSION['nik']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Close the statement
$stmt->close();

// Debugging: Log user data
error_log("Debug: User data: " . print_r($user, true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisoner Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #06283D;
            --secondary-color: #3a7ca5;
            --background-color: #f1f3f8;
            --card-color: #ffffff;
            --accent-color: #f39c12;
            --text-color: #1a3d5e;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f1c40f;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-card {
            background-color: var(--card-color);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background-color: var(--primary-color);
            color: var(--card-color);
            padding: 2rem;
            text-align: center;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid var(--card-color);
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .profile-name {
            font-size: 1.8rem;
            margin: 0;
        }

        .profile-nik, .profile-nrt {
            font-size: 1rem;
            opacity: 0.8;
            margin-top: 0.25rem;
        }

        .profile-info {
            padding: 2rem;
        }

        .profile-info p {
            margin: 0.5rem 0;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid var(--background-color);
            padding-bottom: 0.5rem;
        }

        .profile-info p strong {
            color: var(--secondary-color);
        }

        .status-pemantauan {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .badge.active {
            background-color: var(--success-color);
            color: var(--card-color);
        }

        .btn {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: var(--accent-color);
            color: var(--card-color);
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <?php
                if (isset($user['id'])) {
                    $imagePath = htmlspecialchars($user["fileInput"]);
                    error_log("Debug: Image path: $imagePath");
                    
                    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;
                    if (file_exists($fullPath)) {
                        echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Profile Image' class='profile-photo'>";
                    } else {
                        error_log("Debug: Image file not found at: $fullPath");
                        echo "<img src='/wetrack/lapas/image/nanti-diganti.png' alt='Default Photo' class='profile-photo'>";
                    }
                } else {
                    error_log("Debug: User ID not set");
                    echo "<img src='/wetrack/lapas/image/nanti-diganti.png' alt='Default Photo' class='profile-photo'>";
                }
                ?>
                <h1 class="profile-name"><?php echo htmlspecialchars($user['nama']); ?></h1>
                <p class="profile-nik">NIK: <?php echo htmlspecialchars($user['nik']); ?></p>
                <p class="profile-nrt">NRT: <?php echo htmlspecialchars($user['nrt']); ?></p>
            </div>
            <div class="profile-info">
                <p><strong>Gender:</strong> <span><?php echo htmlspecialchars($user['gender']); ?></span></p>
                <p><strong>Date of Birth:</strong> <span><?php echo htmlspecialchars($user['dateBirth']); ?></span></p>
                <p><strong>Address:</strong> <span><?php echo htmlspecialchars($user['address']); ?></span></p>
                <p><strong>Nationality:</strong> <span><?php echo htmlspecialchars($user['nationality']); ?></span></p>
                <p><strong>Crime:</strong> <span><?php echo htmlspecialchars($user['crime']); ?></span></p>
                <p><strong>Punishment:</strong> <span><?php echo htmlspecialchars($user['punishment']); ?></span></p>
                <p><strong>Release Date:</strong> <span><?php echo htmlspecialchars($user['releaseDate']); ?></span></p>
                <p><strong>Prisoner Type:</strong> <span><?php echo htmlspecialchars($user['prisoner_type']); ?></span></p>
                <div class="status-pemantauan">
                    <strong>Monitoring Status:</strong>
                    <span class="badge active">Active</span>
                </div>
            </div>
            <a href="/wetrack/monitored-individuals/pages/final-report.php" class="btn">View Final Report</a>
        </div>
    </div>
</body>
</html>
<?php
// Close the database connection at the end of the file
$conn->close();
?>