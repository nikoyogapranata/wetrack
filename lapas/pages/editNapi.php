<?php
require __DIR__ . '/../../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $dateBirth = $_POST['dateBirth'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $crime = $_POST['crime'];
    $case = $_POST['case'];
    $punishment = $_POST['punishment'];
    $releaseDate = $_POST['releaseDate'];

    $sql = "UPDATE mantan_narapidana SET 
            nama = ?, 
            dateBirth = ?, 
            address = ?, 
            gender = ?, 
            nationality = ?, 
            crime = ?, 
            `case` = ?, 
            punishment = ?, 
            releaseDate = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $nama, $dateBirth, $address, $gender, $nationality, $crime, $case, $punishment, $releaseDate, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully'); window.location.href='dataNapi.php?id=$id';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM mantan_narapidana WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: data.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Edit Prisoner Data</title>
    <link rel="stylesheet" href="/wetrack/Lapas/css/dataNapi.css">
    <script src="/wetrack/Lapas/js/dataNapi.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="/wetrack/Lapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .edit-form {
            max-width: 100%;
            padding: 25px;
            font-family: 'Poppins', sans-serif;
        }

        .edit-form h2 {
            text-align: center;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .edit-form label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
            color: var(--text-color);
        }

        .edit-form input[type="text"],
        .edit-form input[type="date"],
        .edit-form select,
        .edit-form textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .edit-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        .edit-form button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-form button:hover {
            opacity: 0.7;
        }

        .edit-form .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

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
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="/wetrack/Lapas/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/Lapas/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li class="active"><a href="/wetrack/Lapas/pages/data.php"><i class="fas fa-database"></i>
                            <span>Prisoner Database</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/Laporan.php"><i class="fas fa-file-invoice"></i>
                            <span>Prisoner Final Report</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/setting.php"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="/wetrack/Lapas/Image/lapas-logo.png" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2>Serdy Fambo</h2>
                    <p>Administrative Staff</p>
                </div>
            </div>
        </aside>
        <main class="content">
            <div class="profile-card">
                <div class="path-to-back">
                    <a href="/wetrack/lapas/pages/dataNapi.php?id=<?php echo $id; ?>"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h2>Edit Prisoner Data</h2>
                <form class="edit-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <label for="nama">Name:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>

                    <label for="dateBirth">Date of Birth:</label>
                    <input type="date" id="dateBirth" name="dateBirth" value="<?php echo $row['dateBirth']; ?>" required>

                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required><?php echo $row['address']; ?></textarea>

                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                    </select>

                    <label for="nationality">Nationality:</label>
                    <input type="text" id="nationality" name="nationality" value="<?php echo $row['nationality']; ?>" required>

                    <label for="crime">Type of Crime:</label>
                    <select id="crime" name="crime" required>
                        <option value="TwA" <?php echo ($row['crime'] == 'TwA') ? 'selected' : ''; ?>>Theft with Aggravation</option>
                        <option value="Ot" <?php echo ($row['crime'] == 'Ot') ? 'selected' : ''; ?>>Ordinary Theft</option>
                        <option value="Fraud" <?php echo ($row['crime'] == 'Fraud') ? 'selected' : ''; ?>>Fraud</option>
                        <option value="Assault" <?php echo ($row['crime'] == 'Assault') ? 'selected' : ''; ?>>Assault</option>
                        <option value="NO" <?php echo ($row['crime'] == 'NO') ? 'selected' : ''; ?>>Narcotics Offenses</option>
                        <option value="Embezzlement" <?php echo ($row['crime'] == 'Embezzlement') ? 'selected' : ''; ?>>Embezzlement</option>
                        <option value="MvT" <?php echo ($row['crime'] == 'MvT') ? 'selected' : ''; ?>>Motor Vehicle Theft</option>
                        <option value="Robbery" <?php echo ($row['crime'] == 'Robbery') ? 'selected' : ''; ?>>Robbery</option>
                        <option value="Brawling" <?php echo ($row['crime'] == 'Brawling') ? 'selected' : ''; ?>>Brawling</option>
                    </select>

                    <label for="case">Incident Report:</label>
                    <textarea id="case" name="case" required><?php echo $row['case']; ?></textarea>

                    <label for="punishment">Punishment Period:</label>
                    <input type="text" id="punishment" name="punishment" value="<?php echo $row['punishment']; ?>" required>

                    <label for="releaseDate">Release Date:</label>
                    <input type="date" id="releaseDate" name="releaseDate" value="<?php echo $row['releaseDate']; ?>" required>

                    <button type="submit">Update</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>