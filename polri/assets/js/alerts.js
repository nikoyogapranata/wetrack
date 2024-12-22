document.addEventListener('DOMContentLoaded', function() {
    fetchAlerts();
    setInterval(fetchAlerts, 30000);
  });
  
  async function fetchAlerts() {
    try {
        const response = await fetch(`${window.location.origin}/wetrack/polri/pages/api/alerts.php`);
        const data = await response.json();
        
        if (data.status === 'success') {
            renderAlerts(data.data);
        } else {
            console.error('Failed to fetch alerts:', data.message);
            // Tampilkan pesan error jika data kosong
            const tableBody = document.getElementById('alertTableBody');
            if (tableBody) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="alert alert-warning" role="alert">
                                Failed to load alerts: ${data.message}
                            </div>
                        </td>
                    </tr>
                `;
            }
        }
    } catch (error) {
        console.error('Error fetching alerts:', error);
        const tableBody = document.getElementById('alertTableBody');
        if (tableBody) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">
                        <div class="alert alert-danger" role="alert">
                            Failed to connect to server. Please check your connection.
                        </div>
                    </td>
                </tr>
            `;
        }
    }
  }
  
  async function updateAlertStatus(id, action) {
    try {
        const response = await fetch(`${window.location.origin}/wetrack/polri/pages/api/alerts.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                id: parseInt(id), 
                action: action 
            })
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server sent invalid response format');
        }
  
        const data = await response.json();
        
        if (data.status === 'success') {
            await fetchAlerts();
            return true;
        } else {
            throw new Error(data.message || 'Failed to update status');
        }
    } catch (error) {
        console.error('Error updating status:', error);
        alert('Failed to update report: ' + error.message);
        return false;
    }
  }
  
  async function acceptReport(id) {
    const result = await Swal.fire({
        title: 'Accept Report',
        text: 'Are you sure you want to accept this report?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754', // Bootstrap success color
        cancelButtonColor: '#6c757d',  // Bootstrap secondary color
        confirmButtonText: 'Yes, accept it!',
        cancelButtonText: 'Cancel'
    });
  
    if (result.isConfirmed) {
        const success = await updateAlertStatus(id, 'accept');
        if (success) {
            await Swal.fire({
                title: 'Accepted!',
                text: 'Report has been accepted successfully.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            await Swal.fire({
                title: 'Error!',
                text: 'Failed to accept report. Please try again.',
                icon: 'error'
            });
        }
    }
  }
  
  async function rejectReport(id) {
    const result = await Swal.fire({
        title: 'Reject Report',
        text: 'Are you sure you want to reject this report?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545', // Bootstrap danger color
        cancelButtonColor: '#6c757d',  // Bootstrap secondary color
        confirmButtonText: 'Yes, reject it!',
        cancelButtonText: 'Cancel'
    });
  
    if (result.isConfirmed) {
        const success = await updateAlertStatus(id, 'reject');
        if (success) {
            await Swal.fire({
                title: 'Rejected!',
                text: 'Report has been rejected successfully.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            await Swal.fire({
                title: 'Error!',
                text: 'Failed to reject report. Please try again.',
                icon: 'error'
            });
        }
    }
  }
  
  
  function renderAlerts(alerts) {
    const tableBody = document.getElementById('alertTableBody');
    if (!tableBody) return;
    
    if (!alerts || alerts.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center">
                    No active alerts found
                </td>
            </tr>
        `;
        return;
    }
    
    tableBody.innerHTML = '';
    alerts.forEach((alert, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${escapeHtml(alert.name)}</td>
            <td>${escapeHtml(alert.report)}</td>
            <td>${escapeHtml(alert.time)}</td>
            <td>
                <a href="${escapeHtml(alert.unggah_foto)}" target="_blank" class="btn btn-info btn-sm">
                    View Photo
                </a>
            </td>
            <td>
                <button class="btn-accept" onclick="acceptReport(${alert.id})">Accept</button>
                <button class="btn-reject" onclick="rejectReport(${alert.id})">Reject</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
  
  function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
  }