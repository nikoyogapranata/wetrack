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
                <img src="/wetrack/bapas/Image/bapas-logo.png" alt="Profile picture" width="40" height="40">
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
                    <form id="inputForm" action="save_prisoner.php" method="POST">
                        <div class="form-group">
                            <label for="nik">National ID Number:</label>
                            <input type="text" id="nik" name="nik" placeholder="Enter National ID number" required>
                        </div>
                        <div class="form-group">
                            <label for="nrt">Prisoner Registration Number:</label>
                            <input type="text" id="nrt" name="nrt" placeholder="Enter Prisoner Registration Number" required>
                        </div>
                        <div class="form-group">
                            <label for="typePrisoner">Prisoner Type:</label>
                            <select id="typePrisoner" name="typePrisoner" required onchange="togglePrisonerTypeFields()">
                                <option value="" disabled selected>Select Prisoner Type</option>
                                <option value="houseArrest">House Arrest</option>
                                <option value="cityPrisoner">City Prisoner</option>
                            </select>
                        </div>
                        <div id="houseArrestFields" style="display: none;">
                            <div class="form-group">
                                <label for="radiusFence">Input Geo-Fence Radius (km):</label>
                                <input type="number" id="radiusFence" name="radiusFence" step="0.1" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="map">Select Center Point:</label>
                                <div id="map" style="height: 400px;"></div>
                                <input type="hidden" id="centerLat" name="centerLat">
                                <input type="hidden" id="centerLng" name="centerLng">
                            </div>
                        </div>
                        <div id="cityPrisonerFields" style="display: none;">
                            <div class="form-group">
                                <label for="kotaKab">Choose a city or district:</label>
                                <select id="kotaKab" name="kotaKab" required>
                                    <option value="" disabled selected>Select city or district</option>
                                    <option value="Yogya">Kota Yogyakarta</option>
                                    <option value="Sleman">Kabupaten Sleman</option>
                                    <option value="Bantul">Kabupaten Bantul</option>
                                    <option value="KulonProgo">Kabupaten Kulon Progo</option>
                                    <option value="GunungKidul">Kabupaten Gunung Kidul</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        let map;
        let circle;

        function initMap() {
            map = L.map('map').setView([-7.7956, 110.3695], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            map.on('click', function(e) {
                if (circle) {
                    map.removeLayer(circle);
                }
                const radius = parseFloat(document.getElementById('radiusFence').value) * 1000; // Convert km to meters
                circle = L.circle(e.latlng, {radius: radius}).addTo(map);
                document.getElementById('centerLat').value = e.latlng.lat;
                document.getElementById('centerLng').value = e.latlng.lng;
            });
        }

        function togglePrisonerTypeFields() {
            const prisonerType = document.getElementById('typePrisoner').value;
            document.getElementById('houseArrestFields').style.display = prisonerType === 'houseArrest' ? 'block' : 'none';
            document.getElementById('cityPrisonerFields').style.display = prisonerType === 'cityPrisoner' ? 'block' : 'none';
            if (prisonerType === 'houseArrest' && !map) {
                setTimeout(initMap, 100);
            }
        }

        document.getElementById('radiusFence').addEventListener('input', function() {
            if (circle) {
                circle.setRadius(this.value * 1000);
            }
        });
    </script>
</body>
</html>