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
    const showTableBtn = document.getElementById('showTableBtn');
    const showInputBtn = document.getElementById('showInputBtn');
    const tableContainer = document.querySelector('.table-container');
    const inputContainer = document.querySelector('.input-container');

    function showTable() {
        tableContainer.style.display = 'block';
        inputContainer.style.display = 'none';
        showTableBtn.classList.add('btn-primary');
        showTableBtn.classList.remove('btn-secondary');
        showInputBtn.classList.add('btn-secondary');
        showInputBtn.classList.remove('btn-primary');
    }

    function showInput() {
        tableContainer.style.display = 'none';
        inputContainer.style.display = 'block';
        showInputBtn.classList.add('btn-primary');
        showInputBtn.classList.remove('btn-secondary');
        showTableBtn.classList.add('btn-secondary');
        showTableBtn.classList.remove('btn-primary');
    }

    showTableBtn.addEventListener('click', showTable);
    showInputBtn.addEventListener('click', showInput);

    showTable();

    const inputForm = document.getElementById('inputForm');
    if (inputForm) {
        inputForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
        });
    }
});