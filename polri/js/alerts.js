// Contoh Data Laporan
const reports = [
    { id: 1, name: "Arief Kurniawan", report: "Suspicious activity in Zone A", time: "08:15 AM" },
    { id: 2, name: "Putri Sari", report: "Unauthorized access detected", time: "09:00 AM" },
    { id: 3, name: "Budi Santoso", report: "Possible breach in Zone B", time: "10:30 AM" },
    { id: 4, name: "Dewi Ananda", report: "System anomaly found", time: "11:00 AM" }
  ];
  
  // Render Data ke Tabel
  const tableBody = document.getElementById('alertTableBody');
  
  reports.forEach((report, index) => {
    const row = document.createElement('tr');
  
    row.innerHTML = `
      <td>${index + 1}</td>
      <td>${report.name}</td>
      <td>${report.report}</td>
      <td>${report.time}</td>
      <td>
        <button class="accept-btn" onclick="acceptReport(${report.id}, this)">Accept</button>
        <button class="reject-btn" onclick="rejectReport(${report.id}, this)">Reject</button>
      </td>
    `;
    tableBody.appendChild(row);
  });
  
  // Fungsi untuk Accept Report
  function acceptReport(id, btn) {
    btn.parentElement.innerHTML = `<span class="status accepted">Accepted</span>`;
    alert(`Report ID ${id} has been accepted.`);
  }
  
  // Fungsi untuk Reject Report
  function rejectReport(id, btn) {
    btn.parentElement.innerHTML = `<span class="status rejected">Rejected</span>`;
    alert(`Report ID ${id} has been rejected.`);
  }
  