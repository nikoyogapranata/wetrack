<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require __DIR__ . '/../../config/connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /wetrack/public/login-admin/index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$query = "SELECT id, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $profile_picture);
$stmt->fetch();
$stmt->close();

if (!$profile_picture) {
    $profile_picture = '/wetrack/kemenkumham/Image/kemenkumham.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WETRACK | Database</title>
    <link rel="icon" href="/wetrack/bapas/Image/wetrack-logo-white.png" type="Image/x-icon">
    <link rel="stylesheet" href="/wetrack/bapas/css/data.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="/wetrack/bapas/js/data.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="/wetrack/bapas/Image/wetrack-logo-white.png" alt="WETRACK Logo">
                    <h1 class="logo-text">WETRACK</h1>
                </div>
                <button id="toggle-sidebar" class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="nav-links">
                <ul>
                    <li><a href="/wetrack/bapas/pages/home.php"><i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a></li>
                    <li><a href="/wetrack/bapas/pages/tracking.php"><i class="fas fa-map-marker-alt"></i><span>
                                Tracking Map</span></a></li>
                    <li class="active"><a href="/wetrack/bapas/pages/dataBapas.php"><i class="fas fa-database"></i>
                            <span>Database</span></a></li>

                    <li><a href="/wetrack/bapas/pages/setting.php"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="<?php echo $profile_picture; ?>" alt="Profile picture" width="40" height="40">
                <div class="user-info">
                    <h2><?php echo htmlspecialchars($id); ?></h2>
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
                                <th></th>
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
                                echo "<td><input type='checkbox' class='row-checkbox' data-id='" . $row['id'] . "'></td>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $row['nama'] . "</td>";
                                echo "<td><a href='data-napi.php?id=" . $row['id'] . "' class='btn btn-action'>Details</a></td>";
                                echo "</tr>";
                                $i++;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="input-container" style="display: none;">
                    <form id="inputForm" action="save_prisoner.php" method="POST">
                        <div class="form-group">
                            <label for="nik">National ID Number:</label>
                            <input type="text" id="nik" name="nik" required>
                        </div>
                        <div class="form-group">
                            <label for="nrt">Prisoner Registration Number:</label>
                            <input type="text" id="nrt" name="nrt" required>
                        </div>
                        <div class="form-group">
                            <label for="typePrisoner">Prisoner Type:</label>
                            <select id="typePrisoner" name="typePrisoner" required>
                                <option value="" disabled selected>Select Prisoner Type</option>
                                <option value="houseArrest">House Arrest</option>
                                <option value="cityPrisoner">City Prisoner</option>
                            </select>
                        </div>
                        <div id="houseArrestFields" style="display: none;">
                            <div class="form-group">
                                <label for="radiusFence">Geo-Fence Radius (km):</label>
                                <input type="number" id="radiusFence" name="radiusFence" step="0.1" min="0" value="1">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="centerLat" name="centerLat">
                                <input type="hidden" id="centerLng" name="centerLng">
                            </div>
                            <div id="map" class="form-group"></div>
                        </div>
                        <div id="cityPrisonerFields" style="display: none;">
                            <div class="form-group">
                                <label for="kotaKab">City/District:</label>
                                <select id="kotaKab" name="kotaKab">
                                    <option value="" disabled selected>Select City/District</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="/wetrack/bapas/js/map-socket.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const typePrisonerSelect = document.getElementById('typePrisoner');
    const houseArrestFields = document.getElementById('houseArrestFields');
    const cityPrisonerFields = document.getElementById('cityPrisonerFields');
    const deleteBtn = document.getElementById('delete-btn');

    typePrisonerSelect.addEventListener('change', function() {
        if (this.value === 'houseArrest') {
            houseArrestFields.style.display = 'block';
            cityPrisonerFields.style.display = 'none';
            setTimeout(initMap, 100);
        } else if (this.value === 'cityPrisoner') {
            houseArrestFields.style.display = 'none';
            cityPrisonerFields.style.display = 'block';
        } else {
            houseArrestFields.style.display = 'none';
            cityPrisonerFields.style.display = 'none';
        }
    });

    fetch('/wetrack/bapas/pages/geojson/districts.json')
        .then(response => response.json())
        .then(data => {
            const kotaKabSelect = document.getElementById('kotaKab');
            data.features.forEach(feature => {
                const option = document.createElement('option');
                option.value = feature.properties.name;
                option.textContent = feature.properties.name;
                kotaKabSelect.appendChild(option);
            });
        });

    document.getElementById('inputForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Add geofence data to formData
        if (formData.get('typePrisoner') === 'houseArrest') {
            formData.append('centerLat', document.getElementById('centerLat').value);
            formData.append('centerLng', document.getElementById('centerLng').value);
            formData.append('radiusFence', document.getElementById('radiusFence').value);
        }

        console.log('Form data before sending:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        fetch('save_prisoner.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    alert('Data saved successfully');
                    this.reset();
                } else {
                    alert('Error: ' + data.message);
                    console.error('Error details:', data);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('An error occurred while saving the data');
            });
    });

    // Add event listener for the delete button
    deleteBtn.addEventListener('click', function() {
        const selectedRows = document.querySelectorAll('.row-checkbox:checked');
        if (selectedRows.length === 0) {
            alert('Please select at least one row to delete.');
            return;
        }

        if (confirm('Are you sure you want to delete the selected records?')) {
            const ids = Array.from(selectedRows).map(checkbox => checkbox.getAttribute('data-id'));
            
            fetch('delete_prisoner.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ ids: ids })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Selected records deleted successfully');
                    selectedRows.forEach(checkbox => checkbox.closest('tr').remove());
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the records');
            });
        }
    });
});

function showInput() {
    document.querySelector('.table-container').style.display = 'none';
    document.querySelector('.input-container').style.display = 'block';
}
    </script>
</body>

</html>
