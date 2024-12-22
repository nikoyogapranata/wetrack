// polri/assets/js/dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    // Fetch dashboard data
    fetch('/wetrack/polri/pages/api/dashboard_stats.php')
        .then(response => response.json())
        .then(data => {
            // Update cards
            document.getElementById('totalTracked').textContent = data.total_tracked;
            document.getElementById('alertsAccepted').textContent = data.alerts_accepted;
            document.getElementById('alertsRejected').textContent = data.alerts_rejected;
  
            // Update bar chart
            const ctx = document.getElementById('barChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Individuals', 'Accepted', 'Rejected'],
                    datasets: [{
                        label: 'Case Statistics',
                        data: [
                            data.total_tracked,
                            data.alerts_accepted,
                            data.alerts_rejected
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Case Distribution'
                        }
                    }
                }
            });
  
            // Update recent activities
            const activitiesList = document.getElementById('recentActivitiesList');
            activitiesList.innerHTML = '';
            if (data.recent_activities.length > 0) {
                data.recent_activities.forEach(activity => {
                    const li = document.createElement('li');
                    const date = new Date(activity.created_at);
                    const status = activity.action ? 'accepted' : 'rejected';
                    li.innerHTML = `<strong>${date.toLocaleString()}</strong> - ${activity.nama}'s case was ${status}`;
                    activitiesList.appendChild(li);
                });
            } else {
                activitiesList.innerHTML = '<li>No recent activities</li>';
            }
        })
        .catch(error => {
            console.error('Error fetching dashboard data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to load dashboard data!'
            });
        });
  });