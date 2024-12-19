<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
  <title>Form Penanganan Laporan</title>
  <link rel="stylesheet" href="/polri/css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
=======
<<<<<<< HEAD
  <title>Penanganan Laporan</title>
  <link rel="stylesheet" href="http://localhost/wetrack/polri/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin POLRI</h2>
        <ul>
          <li><a href="http://localhost/wetrack/polri/pages/index.php" style="color: inherit; text-decoration: none;">Dashboard</a></li>
          <li><a href="http://localhost/wetrack/polri/pages/alerts.php" style="color: inherit; text-decoration: none;">Alerts</a></li>
          <li class="active"><a href="http://localhost/wetrack/polri/pages/penanganan.php" style="color: inherit; text-decoration: none;">Penanganan</a></li>
          <li><a href="http://localhost/wetrack/polri/pages/database.php" style="color: inherit; text-decoration: none;">Database</a></li>
          <li><a href="http://localhost/wetrack/polri/pages/profiles.php" style="color: inherit; text-decoration: none;">Profile</a></li>
          <li><a href="http://localhost/wetrack/polri/pages/logout.php" style="color: inherit; text-decoration: none;">Log Out</a></li>
        </ul>
=======
  <title>Form Penanganan Laporan</title>
  <link rel="stylesheet" href="/polri/css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
>>>>>>> Stashed changes
    <nav class="sidebar">
      <h2>Admin POLRI</h2>
      <ul>
        <li><a href="/polri/html/index.html">Dashboard</a></li>
        <li><a href="/polri/html/alerts.html">Alerts</a></li>
        <li class="active"><a href="/polri/html/penanganan.html">Penanganan</a></li>
        <li><a href="/polri/html/database.html">Database</a></li>
        <li><a href="/polri/html/profiles.html">Profile</a></li>
        <li><a href="/polri/html/logout.html">Log Out</a></li>
      </ul>
    </nav>
<<<<<<< Updated upstream

    <main class="main-content">
      <h1>Form Penanganan Laporan</h1>
      <div class="form-container">
        <form action="/polri/html/penanganan.html" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
          </div>

          <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" id="nik" name="nik" required pattern="\d{16}" placeholder="Masukkan 16 digit NIK">
          </div>

          <div class="form-group">
            <label for="id_napi">ID Napi:</label>
            <input type="text" id="id_napi" name="id_napi" required>
          </div>

          <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label for="foto">Unggah Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
          </div>

          <div class="form-group">
            <label for="laporan">Isi Laporan:</label>
            <textarea id="laporan" name="laporan" rows="5" required></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="submit-btn">Kirim Laporan</button>
          </div>
        </form>
      </div>
    </main>

  <script src="/polri/js/penanganan.js"></script>
=======

    <main class="main-content">
      <h1>Form Penanganan Laporan</h1>
      <div class="form-container">
        <form action="/polri/html/penanganan.html" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
          </div>

          <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" id="nik" name="nik" required pattern="\d{16}" placeholder="Masukkan 16 digit NIK">
          </div>

          <div class="form-group">
            <label for="id_napi">ID Napi:</label>
            <input type="text" id="id_napi" name="id_napi" required>
          </div>

          <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label for="foto">Unggah Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
          </div>

          <div class="form-group">
            <label for="laporan">Isi Laporan:</label>
            <textarea id="laporan" name="laporan" rows="5" required></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="submit-btn">Kirim Laporan</button>
          </div>
        </form>
>>>>>>> eb4b3a35da7571982c0408673d331f9dafdcbd52
      </div>
    </main>

<<<<<<< HEAD
  <!-- Main Content -->
  <div class="main-content">
    <h1>Penanganan Laporan</h1>
    <div class="handling-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Pelapor</th>
            <th>Laporan</th>
            <th>Status</th>
            <th>Update Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Budi Santoso</td>
            <td>Perampokan di toko emas</td>
            <td><span class="status pending">Pending</span></td>
            <td>
              <button class="update-btn" onclick="updateStatus(this, 'Processed')">Processed</button>
              <button class="update-btn" onclick="updateStatus(this, 'Resolved')">Resolved</button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Siti Rahma</td>
            <td>Tabrak lari di Jalan Raya</td>
            <td><span class="status pending">Pending</span></td>
            <td>
              <button class="update-btn" onclick="updateStatus(this, 'Processed')">Processed</button>
              <button class="update-btn" onclick="updateStatus(this, 'Resolved')">Resolved</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="http://localhost/wetrack/polri/js/penanganan.js"></script>
=======
  <script src="/polri/js/penanganan.js"></script>
>>>>>>> eb4b3a35da7571982c0408673d331f9dafdcbd52
>>>>>>> Stashed changes
</body>
</html>