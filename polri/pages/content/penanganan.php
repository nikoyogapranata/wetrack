<?php
if (!defined('BASE_PATH')) {
    die('Direct access not permitted');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $id_napi = $_POST['id_napi'];
    $alamat = $_POST['alamat'];
    $isi_laporan = $_POST['isi_laporan'];
    $tanggal_laporan = $_POST['tanggal_laporan'];

    $target_dir = dirname(BASE_PATH) . "/uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $unggah_foto = $_FILES['unggah_foto']['name'];
    $file_extension = pathinfo($unggah_foto, PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . basename($file_name);

    $upload_ok = true;
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo "<script>alert('Format file tidak diizinkan. Hanya JPG, JPEG, PNG, atau GIF yang diizinkan.');</script>";
        $upload_ok = false;
    }

    if ($_FILES['unggah_foto']['size'] > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran file terlalu besar. Maksimal 2MB.');</script>";
        $upload_ok = false;
    }

    if ($upload_ok && move_uploaded_file($_FILES['unggah_foto']['tmp_name'], $target_file)) {
        $db_file_path = '/wetrack/polri/uploads/' . basename($file_name);
        
        $query = "INSERT INTO data_polri (nama, nik, id_napi, alamat, isi_laporan, tanggal_laporan, unggah_foto) 
                  VALUES ('$nama', '$nik', '$id_napi', '$alamat', '$isi_laporan', '$tanggal_laporan', '$db_file_path')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                alert('Laporan berhasil dikirim.');
                window.location.href = '/wetrack/polri/pages/index.php?page=database';
            </script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<h1>Form Penanganan Laporan</h1>
<div class="form-container">
    <form action="" method="POST" enctype="multipart/form-data">
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
            <label for="unggah_foto">Unggah Foto:</label>
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