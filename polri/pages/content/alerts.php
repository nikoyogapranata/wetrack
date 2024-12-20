<?php
if (!defined('BASE_PATH')) {
    die('Direct access not permitted');
}
?>
<div class="alerts-wrapper">
    <div class="alerts-header">
        <h2>Active Alerts</h2>
    </div>
    <div class="alerts-content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Report</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="alertTableBody">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.alerts-wrapper {
    background: white;
    border-radius: 8px;
    margin: 20px;
    overflow: hidden;
}

.alerts-header {
    background: #0d6efd;
    padding: 15px 20px;
}

.alerts-header h2 {
    color: white;
    margin: 0;
    font-size: 24px;
}

.alerts-content {
    padding: 10px;
}

.table {
    margin-bottom: 0;
}

.table th {
    font-weight: normal;
    padding: 10px;
}

.table td {
    padding: 10px;
}

/* Gaya baru untuk tombol */
.btn-accept {
    background: #198754;
    color: white;
    border: none;
    padding: 5px 15px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 14px;
    display: inline-block;
    text-align: center;
    min-width: 60px;
}

.btn-reject {
    background: #dc3545;
    color: white;
    border: none;
    padding: 5px 15px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 14px;
    display: inline-block;
    text-align: center;
    min-width: 60px;
}

.btn-accept:hover, .btn-reject:hover {
    opacity: 0.9;
}

.action-buttons {
    white-space: nowrap;
}
</style>