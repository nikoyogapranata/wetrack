<?php
if (!defined('BASE_PATH')) die('Direct access not permitted');
?>
<div class="header">
    <h1>Dashboard</h1>
</div>
<div class="cards">
    <div class="card">
        <h3>Total Tracked Individuals</h3>
        <h2 id="totalTracked">0</h2>
    </div>
    <div class="card">
        <h3>Alerts Accepted</h3>
        <h2 id="alertsAccepted">0</h2>
    </div>
    <div class="card">
        <h3>Alerts Rejected</h3>
        <h2 id="alertsRejected">0</h2>
    </div>
</div>
<div class="charts">
    <canvas id="barChart"></canvas>
</div>
<div class="recent-activities">
    <h3>Recent Activities</h3>
    <ul id="recentActivitiesList"></ul>
</div>
<script src="/wetrack/polri/assets/js/dashboard.js"></script>
