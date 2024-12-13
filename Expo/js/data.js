document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');

    // Sidebar toggle functionality
    const sidebar = document.querySelector('.sidebar');
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const content = document.querySelector('.content');
    const toggleIcon = toggleSidebar.querySelector('i');

    if (toggleSidebar) {
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