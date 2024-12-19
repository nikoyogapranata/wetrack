<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $id_napi = $_POST['id_napi'];
    $alamat = $_POST['alamat'];
    $isi_laporan = $_POST['isi_laporan'];
    $tanggal_laporan = $_POST['tanggal_laporan'];

    // Handle file upload
    $target_dir = "uploads/";
    $unggah_foto = $_FILES['unggah_foto']['name'];

    // Cek apakah folder uploads ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Buat nama file unik untuk menghindari konflik
    $file_extension = pathinfo($unggah_foto, PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . basename($file_name);

    // Validasi file
    $upload_ok = true;

    // Validasi jenis file
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo "Format file tidak diizinkan. Hanya JPG, JPEG, PNG, atau GIF yang diizinkan.";
        $upload_ok = false;
    }

    // Validasi ukuran file (maksimal 2MB)
    if ($_FILES['unggah_foto']['size'] > 2 * 1024 * 1024) {
        echo "Ukuran file terlalu besar. Maksimal 2MB.";
        $upload_ok = false;
    }

    // Jika validasi berhasil, pindahkan file
    if ($upload_ok && move_uploaded_file($_FILES['unggah_foto']['tmp_name'], $target_file)) {
        // Query untuk memasukkan data ke database
        $query = "INSERT INTO data_polri (nama, nik, id_napi, alamat, isi_laporan, tanggal_laporan, unggah_foto) 
                  VALUES ('$nama', '$nik', '$id_napi', '$alamat', '$isi_laporan', '$tanggal_laporan', '$target_file')";

        if (mysqli_query($conn, $query)) {
            echo "
            <script>
            alert('Laporan berhasil dikirim.');
            document.location.href = '/wetrack/polri/pages/database.php';
            </script>
            ";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Penanganan Laporan</title>
  <link rel="stylesheet" href="/wetrack/polri/css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="sidebar">
      <h2>Admin POLRI</h2>
      <ul>
        <li><a href="/polri/pages/html/index.php">Dashboard</a></li>
        <li><a href="/polri/pages/html/alerts.php">Alerts</a></li>
        <li class="active"><a href="/polri/pages/html/penanganan.php">Penanganan</a></li>
        <li><a href="/polri/pages/html/database.php">Database</a></li>
        <li><a href="/polri/pages/html/profiles.php">Profile</a></li>
        <li><a href="/polri/pages/html/logout.php">Log Out</a></li>
      </ul>
    </nav>

    <main class="main-content">
      <h1>Form Penanganan Laporan</h1>
      <div class="form-container">
      <form action="/wetrack/polri/pages/penanganan.php" method="POST" enctype="multipart/form-data">
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
            <label for="isi_laporan">Isi Laporan:</label>
            <textarea id="isi_laporan" name="isi_laporan" rows="5" required></textarea>
          </div>

          <div class="form-group">
            <label for="tanggal_laporan">Tanggal Laporan:</label>
            <input type="date" id="tanggal_laporan" name="tanggal_laporan" required>
          </div>

          <div class="form-group">
            <button type="submit" name="submit" class="submit-btn">Kirim Laporan</button>
          </div>
        </form>
      </div>
    </main>

  <script src="/polri/js/penanganan.js"></script>
</body>
</html>