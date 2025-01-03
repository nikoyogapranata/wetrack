document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('delete-btn');
    const actionButtons = document.querySelectorAll('.btn-action');
    const searchInput = document.getElementById('searchInput');
    let deleteMode = false;

    deleteBtn.addEventListener('click', function() {
        deleteMode = !deleteMode;
        if (deleteMode) {
            this.textContent = 'Cancel Delete';
            this.classList.add('btn-danger');
            actionButtons.forEach(btn => {
                btn.textContent = 'Delete Data';
                btn.classList.add('btn-danger');
            });
        } else {
            this.textContent = 'Delete';
            this.classList.remove('btn-danger');
            actionButtons.forEach(btn => {
                btn.textContent = 'View Details';
                btn.classList.remove('btn-danger');
            });
        }
    });

    document.querySelector('table').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-action')) {
            const id = e.target.getAttribute('data-id');
            if (deleteMode) {
                if (confirm('Are you sure you want to delete this record?')) {
                    deleteRecord(id);
                }
            } else {
                window.location.href = "dataNapi.php?id=" + id;
            }
        }
    });

    function deleteRecord(id) {
        fetch(`delete-record.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Record deleted successfully');
                location.reload();
            } else {
                alert('Error deleting record');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting record');
        });
    }

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});