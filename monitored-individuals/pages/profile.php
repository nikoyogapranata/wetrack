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

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisoner Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/wetrack/monitored-individuals/css/profile.css">
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="<?php echo $user['fileInput']; ?>" alt="Prisoner Photo" class="profile-photo">
                <h1 class="profile-name"><?php echo $user['nama']; ?></h1>
                <p class="profile-nik"><strong>NIK:</strong> <?php echo $user['nik']; ?></p>
                <img src="/wetrack/monitored-individuals/images/Ousmane_Dembele_Barcelona_2021-22.jpg.webp" alt="Prisoner Photo" class="profile-photo">
                <h1 class="profile-name">Ousamane Dembele</h1>
                <p class="profile-nik"><strong>ID Number:</strong> 1234567890123456</p>
            </div>
            <div class="profile-info">
                <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $user['dateBirth']; ?></p>
                <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
                <p><strong>Status:</strong> <?php echo $user['prisoner_type']; ?></p>
                <p><strong>Gender:</strong> Male</p>
                <p><strong>Date of Birth:</strong> 01/01/1990</p>
                <p><strong>Address:</strong> 123 Main Street, Jakarta City, 12345</p>
                <p><strong>Status:</strong> House Arrest</p>
                <div class="status-pemantauan">
                    <strong>Monitoring Status:</strong>
                    <span class="badge active">Active</span>
                </div>
                <!-- Add more fields as needed -->
            </div>
            <a href="/wetrack/monitored-individuals/pages/final-report.php" class="btn">View Laporan Akhir</a>
            <button href="/wetrack/monitored-individuals/pages/final-report.php" id="viewReportBtn" class="btn">View Final Report</button>
        </div>
    </div>
    <script src="/wetrack/monitored-individuals/js/profile.js"></script>
</body>
</html>