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
            { id: 1, name: "John Doe"},
            { id: 2, name: "Jane Smith"},
            { id: 3, name: "Mike Johnson"},
            { id: 4, name: "Emily Brown"},
            { id: 5, name: "David Wilson"}
        ];

        // Populate inmate table
        inmates.forEach((inmate, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${inmate.name}</td>
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
    console.log(`Navigating to details page for inmate with ID: ${inmateId}`);
    window.location.href = `dataNapi.html?id=${inmateId}`;
}

