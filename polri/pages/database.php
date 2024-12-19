<?php
require 'connection.php';

$query = "SELECT * FROM data_polri";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="/wetrack/polri/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin POLRI</h2>
        <ul>
            <li><a href="/wetrack/polri/pages/index.php">Dashboard</a></li>
            <li><a href="/wetrack/polri/pages/alerts.php">Alerts</a></li>
            <li><a href="/wetrack/polri/pages/penanganan.php">Penanganan</a></li>
            <li class="active"><a href="/wetrack/polri/pages/database.php">Database</a></li>
            <li><a href="/wetrack/polri/pages/profiles.php">Profile</a></li>
            <li><a href="/wetrack/polri/pages/logout.php">Log Out</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Database</h1>
        <div class="database-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row["id"]; ?></td>
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["alamat"]; ?></td>
                            <td><?= $row["nik"]; ?></td>
                            <td><img src="<?= $row["unggah_foto"]; ?>" alt="foto" width="50"></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
