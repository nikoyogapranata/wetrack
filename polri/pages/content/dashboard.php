<?php
if(!defined('BASE_PATH')) {
    die('Direct access not permitted');
}
?>
<div class="header">
    <h1>Dashboard</h1>
    <input type="text" placeholder="Search...">
</div>
<div class="cards">
    <div class="card">
        <h3>Total Tracked Individuals</h3>
        <h2 id="totalTracked">Loading...</h2>
        <p class="green">Total registered individuals</p>
    </div>
    <div class="card">
        <h3>Alerts Accepted</h3>
        <h2 id="alertsAccepted">Loading...</h2>
        <p class="green">Approved cases</p>
    </div>
    <div class="card">
        <h3>Alerts Rejected</h3>
        <h2 id="alertsRejected">Loading...</h2>
        <p class="red">Rejected cases</p>
    </div>
</div>
<div class="charts">
    <canvas id="barChart" width="400" height="200"></canvas>
</div>
<div class="recent-activities">
    <h3>Recent Activities</h3>
    <ul id="recentActivitiesList">
        <li>Loading activities...</li>
    </ul>
</div>

<script src="/wetrack/polri/assets/js/dashboard.js"></script>