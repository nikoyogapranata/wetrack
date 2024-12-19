<?php
if (!defined('BASE_PATH')) {
    die('Direct access not permitted');
}

// Query lengkap untuk mengambil semua data yang diperlukan
$query = "SELECT * FROM data_polri";
$result = mysqli_query($conn, $query);
?>

<div class="header">
    <h1>Database</h1>
</div>
<div class="database-container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>NIK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row["id"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["alamat"]; ?></td>
                    <td><?= $row["nik"]; ?></td>
                    <td>
                        <button 
                            type="button" 
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" 
                            data-bs-target="#detailModal"
                            onclick='showNapiDetail(<?= json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'
                        >
                            Detail
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Narapidana</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img id="modalFoto" src="" alt="Foto Narapidana" class="img-fluid rounded mb-3" style="max-height: 300px; width: auto;">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th width="30%">ID</th>
                                <td><span id="modalId"></span></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td><span id="modalNama"></span></td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td><span id="modalNik"></span></td>
                            </tr>
                            <tr>
                                <th>ID Napi</th>
                                <td><span id="modalIdNapi"></span></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><span id="modalAlamat"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Laporan</th>
                                <td><span id="modalTanggal"></span></td>
                            </tr>
                            <tr>
                                <th>Isi Laporan</th>
                                <td><span id="modalLaporan"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>