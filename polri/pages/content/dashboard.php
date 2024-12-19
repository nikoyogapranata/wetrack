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
        <h2>1,365</h2>
        <p class="green">+5% from last month</p>
    </div>
    <div class="card">
        <h3>Active Alerts</h3>
        <h2>7</h2>
        <p class="red">Requires immediate attention</p>
    </div>
    <div class="card">
        <h3>Successful Registrations</h3>
        <h2>152</h2>
        <p class="green">+12% this week</p>
    </div>
</div>

<div class="charts">
    <canvas id="myChart" width="400" height="200"></canvas>
</div>

<div class="recent-activities">
    <h3>Recent Activities</h3>
    <ul>
        <li><strong>09:45</strong> New registration added</li>
        <li><strong>08:30</strong> Alert triggered in Zone B</li>
        <li><strong>07:15</strong> System update completed</li>
        <li><strong>Yesterday</strong> Monthly report generated</li>
    </ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Monthly Registrations',
                data: [65, 59, 80, 81, 56, 55],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>