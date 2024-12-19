<?php
if (!defined('BASE_PATH')) {
    die('Direct access not permitted');
}
?>

<div class="header">
    <h1>Active Alerts</h1>
</div>
<div class="alerts-container">
    <table>
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
            <!-- Data Rows Will be Rendered Here by JS -->
        </tbody>
    </table>
</div>

<script src="/wetrack/polri/assets/js/alerts.js"></script>