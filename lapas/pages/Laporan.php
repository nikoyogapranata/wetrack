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
                                <td>John Doe</td>
                                <td><button class="btn btn-action">Details</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td><button class="btn btn-action">Details</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="input-container" style="display: none;">
                    <form id="inputForm">
                        <div class="form-group">
                            <label for="nik">National ID Number:</label>
                            <input type="text" id="nik" name="nik" placeholder="Enter National ID number" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="nama" name="nama" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="nrt">Prisoner Registration Number:</label>
                            <input type="text" id="nrt" name="nrt" placeholder="Enter Prisoner Registration Number"
                                required>
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
                            <label for="punishment">Punishment Period:</label>
                            <input type="text" id="punishment" name="punishment" placeholder="Enter Punishment Period"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="monitoringDate">Monitoring Start Date:</label>
                            <input type="date" id="monitoringDate" name="monitoringDate" required>
                        </div>
                        <div class="form-group">
                            <label for="monitoringEndDate">Monitoring End Date:</label>
                            <input type="date" id="monitoringEndDate" name="monitoringEndDate" required>
                        </div>
                        <div class="form-group">
                            <label for="information">Information:</label>
                            <textarea name="information" id="information" placeholder="Enter information"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="finalStatus">Final Status and Recommendations:</label>
                            <textarea name="finalStatus" id="finalStatus" placeholder="Enter Final Status and Recommendations"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>