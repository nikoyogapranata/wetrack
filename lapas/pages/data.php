<?php
require __DIR__ . '/../../config/connection.php';  // Corrected path
require_once 'utils/activity_logger.php';
if (isset($_POST["submit"])) {
    $fileInput = $_FILES["fileInput"]["name"];
    $nik = $_POST["nik"];
    $nrt = $_POST["nrt"];
    $nama = $_POST["nama"];
    $dateBirth = $_POST["dateBirth"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $nationality = $_POST["nationality"];
    $nationality = ucwords(str_replace('-', ' ', $nationality));
    $crime = $_POST["crime"];
    $case = $_POST["case"];
    $punishment = $_POST["punishment"];
    $releaseDate = $_POST["releaseDate"];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
    move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file);

    $query = "INSERT INTO mantan_narapidana (fileInput, nik, nrt, nama, dateBirth, address, gender, nationality, crime, `case`, punishment, releaseDate) 
              VALUES ('$target_file', '$nik', '$nrt', '$nama', '$dateBirth', '$address', '$gender', '$nationality', '$crime', '$case', '$punishment', '$releaseDate')";

    if (mysqli_query($conn, $query)) {
        logRecentActivity("create", "New user account created: " . $nama);
        echo "
        <script>
        alert('Data Added Successfully');
        document.location.href = '/wetrack/lapas/pages/dataNapi.php';
        </script>
        ";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Database</title>
    <link rel="icon" href="/wetrack/Lapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" type="text/css" href="/wetrack/lapas/css/data.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/wetrack/lapas/js/data.js" defer></script>
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
        }</style>
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
                    <li><a href="/wetrack/lapas/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li class="active"><a href="/wetrack/Lapas/pages/data.php"><i class="fas fa-database"></i>
                            <span>Prisoner Database</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/Laporan.php"><i class="fas fa-file-invoice"></i><span>Final
                                Report</span></a></li>
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
            <div class="content-container">
                <div class="content-header">
                    <h1>Database</h1>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search...">
                    </div>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" id="showTableBtn">All</button>
                    <button class="btn btn-secondary" id="showInputBtn">Input Data</button>
                    <button class="delete-btn" id="delete-btn">Delete</button>
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
                            <?php
                            $result = mysqli_query($conn, "SELECT mn.id, mn.nama 
                               FROM mantan_narapidana mn 
                               LEFT JOIN final_report fr ON mn.nik = fr.nik AND mn.nrt = fr.nrt 
                               WHERE fr.id IS NULL 
                               ORDER BY mn.id ASC");
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $row['nama'] . "</td>";
                                echo "<td><button class='btn btn-action' data-id='" . $row['id'] . "'>Details</button> </td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="input-container" style="display: none;">
                    <form id="inputForm" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" name="fileInput" id="fileInput" accept=".png, .jpg, .jpeg, .webp" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">National ID Number:</label>
                            <input type="text" id="nik" name="nik" placeholder="Enter National ID number" required>
                        </div>
                        <div class="form-group">
                            <label for="nrt">Prisoner Registration Number:</label>
                            <input type="text" id="nrt" name="nrt" placeholder="Enter Prisoner Registration Number" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
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
                        <div class="form-group">
                            <label for="crime">Type of Crime:</label>
                            <select id="crime" name="crime" required>
                                <option value="" disabled selected>Select type of crime</option>
                                <option value="TwA">Theft with Aggravation</option>
                                <option value="Ot">Ordinary Theft</option>
                                <option value="Fraud">Fraud</option>
                                <option value="Assault">Assault</option>
                                <option value="NO">Narcotics Offenses</option>
                                <option value="Embezzlement">Embezzlement</option>
                                <option value="MvT">Motor Vehicle Theft</option>
                                <option value="Robbery">Robbery</option>
                                <option value="Brawling">Brawling</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="case">Incident Report:</label>
                            <textarea name="case" id="case" placeholder="Enter Incident Report" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="punishment">Punishment Period:</label>
                            <input type="text" id="punishment" name="punishment" placeholder="Enter Punishment Period" required>
                        </div>
                        <div class="form-group">
                            <label for="releaseDate">Release Date:</label>
                            <input type="date" id="releaseDate" name="releaseDate" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        
    </script>
    <script src="/wetrack/lapas/js/delete-functionality.js"></script>
</body>

</html>

