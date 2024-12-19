<div id="napiDetailDialog" class="dialog-overlay">
    <div class="dialog-content">
        <div class="dialog-header">
            <h2>Detail Narapidana</h2>
            <button class="close-btn" onclick="closeDialog()">&times;</button>
        </div>
        <div class="dialog-body">
            <div class="detail-grid">
                <div class="detail-image">
                    <img id="napiPhoto" src="" alt="Foto Napi" class="napi-photo">
                </div>
                <div class="detail-info">
                    <div class="info-group">
                        <label>ID:</label>
                        <p id="napiId"></p>
                    </div>
                    <div class="info-group">
                        <label>Nama:</label>
                        <p id="napiName"></p>
                    </div>
                    <div class="info-group">
                        <label>NIK:</label>
                        <p id="napiNik"></p>
                    </div>
                    <div class="info-group">
                        <label>ID Napi:</label>
                        <p id="napiIdNumber"></p>
                    </div>
                    <div class="info-group">
                        <label>Alamat:</label>
                        <p id="napiAddress"></p>
                    </div>
                    <div class="info-group">
                        <label>Tanggal Laporan:</label>
                        <p id="napiReportDate"></p>
                    </div>
                    <div class="info-group">
                        <label>Isi Laporan:</label>
                        <p id="napiReport"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Tambahkan di styles.css atau inline */
.dialog-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.dialog-content {
    position: relative;
    background-color: #fff;
    width: 80%;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
    transform: translateY(-20px);
    opacity: 0;
    transition: all 0.3s ease;
}

.dialog-overlay.active {
    opacity: 1;
}

.dialog-overlay.active .dialog-content {
    transform: translateY(0);
    opacity: 1;
}

.dialog-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.close-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
}

.detail-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 20px;
}

.detail-image img {
    width: 100%;
    border-radius: 8px;
}

.info-group {
    margin-bottom: 15px;
}

.info-group label {
    font-weight: bold;
    color: #666;
    margin-bottom: 5px;
    display: block;
}

.info-group p {
    margin: 0;
    color: #333;
}

.detail-btn {
    background-color: #1d2b53;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.detail-btn:hover {
    background-color: #2a3b6e;
}
</style>