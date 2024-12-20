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
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format file tidak diizinkan. Hanya JPG, JPEG, PNG, atau GIF yang diizinkan.'
            });
        </script>";
        $upload_ok = false;
    }

    if ($_FILES['unggah_foto']['size'] > 2 * 1024 * 1024) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ukuran file terlalu besar. Maksimal 2MB.'
            });
        </script>";
        $upload_ok = false;
    }

    if ($upload_ok && move_uploaded_file($_FILES['unggah_foto']['tmp_name'], $target_file)) {
        $db_file_path = '/wetrack/polri/uploads/' . basename($file_name);
        
        $query = "INSERT INTO data_polri (nama, nik, id_napi, alamat, isi_laporan, tanggal_laporan, unggah_foto) 
                  VALUES ('$nama', '$nik', '$id_napi', '$alamat', '$isi_laporan', '$tanggal_laporan', '$db_file_path')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Laporan berhasil dikirim.',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: () => {
                        window.location.href = '/wetrack/polri/pages/index.php?page=database';
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error: " . mysqli_error($conn) . "'
                });
            </script>";
        }
    } else if ($upload_ok) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal mengunggah file.'
            });
        </script>";
    }
}
?>

<h1>Form Penanganan Laporan</h1>
<div class="form-container">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group mb-3">
            <label for="nik" class="form-label">NIK:</label>
            <input type="text" class="form-control" id="nik" name="nik" required pattern="\d{16}" 
                   placeholder="Masukkan 16 digit NIK">
        </div>

        <div class="form-group mb-3">
            <label for="id_napi" class="form-label">ID Napi:</label>
            <input type="text" class="form-control" id="id_napi" name="id_napi" required>
        </div>

        <div class="form-group mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="unggah_foto" class="form-label">Unggah Foto:</label>
            <input type="file" class="form-control" id="unggah_foto" name="unggah_foto" accept="image/*" required>
        </div>

        <div class="form-group mb-3">
            <label for="isi_laporan" class="form-label">Isi Laporan:</label>
            <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="5" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_laporan" class="form-label">Tanggal Laporan:</label>
            <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Kirim Laporan</button>
        </div>
    </form>
</div>

<style>
.form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Custom styling untuk SweetAlert */
.swal2-popup {
    font-size: 1rem !important;
}

.swal2-title {
    font-size: 1.5rem !important;
}

.swal2-icon {
    width: 5em !important;
    height: 5em !important;
}
</style>