document.addEventListener('DOMContentLoaded', function () {
    fetch('/wetrack/polri/pages/api/dashboard_stats.php')
        .then(response => response.json())
        .then(data => {
            animateNumber('totalTracked', data.total_tracked);
            animateNumber('alertsAccepted', data.alerts_accepted);
            animateNumber('alertsRejected', data.alerts_rejected);

            createBarChart(data.monthly_data);
            updateRecentActivities(data.recent_activities);
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load data!' });
        });
});

function animateNumber(id, finalNumber) {
    const el = document.getElementById(id);
    let current = 0;
    const step = finalNumber / 100;
    const interval = setInterval(() => {
        current += step;
        el.textContent = Math.min(Math.round(current), finalNumber);
        if (current >= finalNumber) clearInterval(interval);
    }, 10);
}

function createBarChart(data) {
    const ctx = document.getElementById('barChart').getContext('2d');
    const labels = data.map(d => d.month);
    const counts = data.map(d => d.count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Registrations',
                data: counts,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
}

function updateRecentActivities(activities) {
    const list = document.getElementById('recentActivitiesList');
    list.innerHTML = '';
    if (activities.length === 0) {
        list.innerHTML = '<li>No recent activities</li>';
        return;
    }
    activities.forEach(act => {
        const li = document.createElement('li');
        li.textContent = `${act.action_type}: ${act.action_description} (${new Date(act.created_at).toLocaleString()})`;
        list.appendChild(li);
    });
}