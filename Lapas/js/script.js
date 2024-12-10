document.addEventListener('DOMContentLoaded', function () {
    // Sidebar toggle functionality
    const sidebar = document.querySelector('.sidebar');
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const content = document.querySelector('.content');
    const toggleIcon = toggleSidebar.querySelector('i');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('expanded');
        
        // Change icon
        if (sidebar.classList.contains('collapsed')) {
            toggleIcon.classList.remove('fa-chevron-left');
            toggleIcon.classList.add('fa-chevron-right');
        } else {
            toggleIcon.classList.remove('fa-chevron-right');
            toggleIcon.classList.add('fa-chevron-left');
        }
    });

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    // Chart functionality (if on the dashboard page)
    const summaryChart = document.getElementById('summaryChart');
    if (summaryChart) {
        const ctx = summaryChart.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [1000, 950, 1180, 1280, 1300, 1365],
                    borderColor: '#3498db',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: 'rgba(52, 152, 219, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                scales: {
                    x: {
                        display: false,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: false,
                        grid: {
                            display: false
                        },
                        min: 900,
                        max: 1400
                    }
                }
            }
        });
    }

    // Inmate tracking table functionality
    populateInmateTable();
});

function populateInmateTable() {
    const inmateTableBody = document.getElementById('inmateTableBody');
    console.log('Inmate table body:', inmateTableBody);

    if (inmateTableBody) {
        console.log('Populating inmate table');
        // Inmate data
        const inmates = [
            { id: 1, name: "John Doe", status: "active" },
            { id: 2, name: "Jane Smith", status: "inactive" },
            { id: 3, name: "Mike Johnson", status: "escaped" },
            { id: 4, name: "Emily Brown", status: "active" },
            { id: 5, name: "David Wilson", status: "inactive" }
        ];

        // Populate inmate table
        inmates.forEach((inmate, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${inmate.name}</td>
                <td>
                    <span class="status-indicator status-${inmate.status}"></span>
                    ${capitalizeFirstLetter(inmate.status)}
                </td>
                <td>
                    <button class="details-button" onclick="showInmateDetails(${inmate.id})">Details</button>
                </td>
            `;
            inmateTableBody.appendChild(row);
        });
        console.log('Inmate table populated');
    } else {
        console.error('Inmate table body not found');
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function showInmateDetails(inmateId) {
    console.log(`Showing details for inmate with ID: ${inmateId}`);
    alert(`Navigating to details page for inmate with ID: ${inmateId}`);
}

function goToHome() {
    window.location.href = "home.html";
}