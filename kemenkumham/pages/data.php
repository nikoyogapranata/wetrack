<?php
// Include database connection
include('connect.php'); // Adjust the path as needed

// Assuming you have a session that holds the user ID (e.g., from login)
session_start();
$user_id = $_SESSION['user_id']; // Or any method you're using to store the logged-in user ID

// Fetch user information from the database
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
    <title>WETRACK | Database</title>
    <link rel="icon" href="/wetrack/kemenkumham/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/kemenkumham/css/data.css">
    <script src="/wetrack/kemenkumham/js/data.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <li><a href="/wetrack/kemenkumham/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li class="active"><a href="/wetrack/kemenkumham/pages/data.php"><i class="fas fa-database"></i>
                            <span>Database</span></a></li>
                    <li><a href="/wetrack//kemenkumham/pages/setting.php"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
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
                <div class="content-header">
                    <h1>Database</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Search...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" id="showTableBtn">All</button>
                    <button class="btn btn-secondary" id="showInputBtn" onclick="showInput()">Input Data</button>
                    <button class="delete-btn" id="delete-btn" class="btn btn-danger">Delete</button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Chou Tzuyu</td>
                                <td><button class="btn btn-action" id="btn-details">Details</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Gita Sekar Andarini</td>
                                <td><button class="btn btn-action" id="btn-details">Details</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="input-container" style="display: none;">
                    <form id="inputForm">
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" id="fileInput" accept=".png, .jpg, .jpeg" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">National ID Number:</label>
                            <input type="text" id="nik" name="nik"  placeholder="Enter National ID number" required>
                        </div>
                        <div class="form-group">
                            <label for="nrt">National Employee Number:</label>
                            <input type="text" id="nrt" name="nrt"  placeholder="Enter Prisoner Registration Number" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" id="nama" name="nama" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="dateBirth">Date of Birth:</label>
                            <input type="date" id="dateBirth" name="dateBirth" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea name="address" id="address" placeholder="Enter Address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality:</label>
                            <select id="nationality" name="nationality" required>
                                <option value="" disabled selected>Select Nationality</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>