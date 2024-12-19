<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Penanganan Laporan</title>
  <link rel="stylesheet" href="/polri/css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
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
            <input type="file" id="unggah_foto" name="unggah_foto" accept="image/*" required>
          </div>

          <div class="form-group">
            <label for="laporan">Isi Laporan:</label>
            <textarea id="isi_laporan" name="isi_laporan" rows="5" required></textarea>
          </div>

          <div class="form-group">
            <label for="tanggal_laporan">Tanggal Laporan:</label>
            <input id="tanggal_laporan" name="tanggal_laporan" type="date" required></input>
          </div>

          <div class="form-group">
            <button type="submit" class="submit-btn">Kirim Laporan</button>
          </div>
        </form>
      </div>
    </main>

  <script src="/polri/js/penanganan.js"></script>
</body>
</html>