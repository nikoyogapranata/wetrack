<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../../config/connection.php';  // Corrected path
require_once 'utils/activity_logger.php';

if (isset($_POST["submit"])) {
    $nik = $_POST["nik"];
    $nrt = $_POST["nrt"];

    // Check if the nik and nrt exist in mantan_narapidana table
    $check_query = "SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ss", $nik, $nrt);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // nik and nrt exist, proceed with file upload and database insertion
        $docInput = $_FILES["docInput"]["name"];
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["docInput"]["name"]);
        
        if (move_uploaded_file($_FILES["docInput"]["tmp_name"], $target_file)) {
            // File upload successful, proceed with database insertion
            $query = "INSERT INTO final_report (nik, nrt, docInput) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $nik, $nrt, $target_file);
            
            if ($stmt->execute()) {
                logRecentActivity("report", "Final report created for NRT: " . $nrt);
                echo "
                <script>
                alert('Final report added successfully');
                document.location.href = '/wetrack/lapas/pages/Laporan.php';
                </script>
                ";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file. Error: " . error_get_last()['message'];
        }
    } else {
        echo "
        <script>
        alert('Invalid NIK or NRT. Please check and try again.');
        document.location.href = '/wetrack/lapas/pages/Laporan.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Final Report</title>
    <link rel="stylesheet" href="/wetrack/Lapas/css/data.css">
    <script src="/wetrack/Lapas/js/data.js"></script>
    <link rel="icon" href="/wetrack/Lapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
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
                    <li><a href="/wetrack/Lapas/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/Lapas/pages/data.php"><i class="fas fa-database"></i>
                            <span>Database</span></a></li>
                    <li class="active"><a href="/wetrack/Lapas/pages/Laporan.php"><i
                                class="fas fa-file-invoice"></i> <span>Final Report</span></a></li>
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
                    <h1>Final Report</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Search...">
                        <i class="fas fa-search"></i>
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
                                <th>NIK</th>
                                <th>NRT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($conn, "SELECT fr.id, mn.nama, fr.nik, fr.nrt, fr.docInput FROM final_report fr JOIN mantan_narapidana mn ON fr.nik = mn.nik AND fr.nrt = mn.nrt ORDER BY fr.id DESC");
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $row['nama'] . "</td>";
                                echo "<td>" . $row['nik'] . "</td>";
                                echo "<td>" . $row['nrt'] . "</td>";
                                echo "<td><button class='btn btn-action' data-id='" . $row['id'] . "' data-doc='" . $row['docInput'] . "'>Details</button></td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="input-container" style="display: none;">
                    <form id="inputForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nik">National ID Number:</label>
                            <input type="text" id="nik" name="nik" placeholder="Enter National ID number" required>
                        </div>
                        <div class="form-group">
                            <label for="nrt">Prisoner Registration Number:</label>
                            <input type="text" id="nrt" name="nrt" placeholder="Enter Prisoner Registration Number" required>
                        </div>
                        <div class="form-group">
                            <label for="docInput">Upload Final Report:</label>
                            <input type="file" name="docInput" id="docInput" accept=".pdf, .doc, .docx" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let deleteMode = false;
            const deleteBtn = document.getElementById('delete-btn');
            const actionButtons = document.querySelectorAll('.btn-action');

            $('#nik').on('input', function() {
                var nik = $(this).val();
                if(nik.length > 2) {
                    $.ajax({
                        url: 'get_nrt.php',
                        method: 'POST',
                        data: {nik: nik},
                        dataType: 'json',
                        success: function(response) {
                            if(response.nrt) {
                                $('#nrt').val(response.nrt);
                            } else {
                                $('#nrt').val('');
                            }
                        }
                    });
                }
            });

            deleteBtn.addEventListener('click', function() {
                deleteMode = !deleteMode;
                if (deleteMode) {
                    this.textContent = 'Cancel Delete';
                    this.classList.add('btn-danger');
                    actionButtons.forEach(btn => {
                        btn.textContent = 'Delete Data';
                        btn.classList.add('btn-danger');
                    });
                } else {
                    this.textContent = 'Delete';
                    this.classList.remove('btn-danger');
                    actionButtons.forEach(btn => {
                        btn.textContent = 'Details';
                        btn.classList.remove('btn-danger');
                    });
                }
            });

            document.querySelector('table').addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-action')) {
                    const id = e.target.getAttribute('data-id');
                    const docPath = e.target.getAttribute('data-doc');
                    if (deleteMode) {
                        if (confirm('Are you sure you want to delete this record?')) {
                            deleteRecord(id);
                        }
                    } else {
                        window.open(docPath, '_blank');
                    }
                }
            });

            function deleteRecord(id) {
                fetch(`delete-final-report.php?id=${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Record deleted successfully');
                        location.reload();
                    } else {
                        alert('Error deleting record: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting record');
                });
            }

            // Search functionality
            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('table tbody tr').each(function() {
                    const name = $(this).find('td:nth-child(2)').text().toLowerCase();
                    const nik = $(this).find('td:nth-child(3)').text().toLowerCase();
                    const nrt = $(this).find('td:nth-child(4)').text().toLowerCase();
                    if (name.includes(searchTerm) || nik.includes(searchTerm) || nrt.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>
</html>