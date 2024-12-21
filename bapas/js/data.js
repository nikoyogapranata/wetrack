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
        const headerContent = document.querySelector('.search-bar');
        const btnDelete = document.querySelector('.delete-btn');
        const btnDetails = document.querySelector('.btn-details');
    
        function showTable() {
            tableContainer.style.display = 'block';
            inputContainer.style.display = 'none';
            headerContent.style.display = 'block';
            btnDelete.style.display ='block';
            showTableBtn.classList.add('btn-primary');
            showTableBtn.classList.remove('btn-secondary');
            showInputBtn.classList.add('btn-secondary');
            showInputBtn.classList.remove('btn-primary');
        }
    
        function showInput() {
            tableContainer.style.display = 'none';
            inputContainer.style.display = 'block';
            headerContent.style.display = 'none';
            btnDelete.style.display ='none';
            showInputBtn.classList.add('btn-primary');
            showInputBtn.classList.remove('btn-secondary');
            showTableBtn.classList.add('btn-secondary');
            showTableBtn.classList.remove('btn-primary');
        }

    showTableBtn.addEventListener('click', showTable);
    showInputBtn.addEventListener('click', showInput);

    showTable();

    const inputForm = document.getElementById('inputForm');
    const typePrisonerSelect = document.getElementById('typePrisoner');
    const houseArrestFields = document.getElementById('houseArrestFields');
    const cityPrisonerFields = document.getElementById('cityPrisonerFields');

    if (inputForm && typePrisonerSelect) {
        typePrisonerSelect.addEventListener('change', function() {
            const selectedType = this.value;
            console.log('Selected prisoner type:', selectedType);

            if (selectedType === 'houseArrest') {
                houseArrestFields.style.display = 'block';
                cityPrisonerFields.style.display = 'none';
            } else if (selectedType === 'cityPrisoner') {
                houseArrestFields.style.display = 'none';
                cityPrisonerFields.style.display = 'block';
            } else {
                houseArrestFields.style.display = 'none';
                cityPrisonerFields.style.display = 'none';
            }
        });

        inputForm.addEventListener('submit', handleFormSubmit);
    }

    document.getElementById("btn-details").addEventListener("click",function(){
        window.location.href ="data-napi.html";
    })
});

function handleFormSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    fetch('save_prisoner.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            form.reset();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the data. Please check the console for more information.');
    });
}
