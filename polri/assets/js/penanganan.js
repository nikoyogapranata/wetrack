function navigateTo(page) {
  window.location.href = page;
}

// Fungsi untuk Update Status Laporan
function updateStatus(button, status) {
  const row = button.closest('tr'); // Cari baris laporan
  const statusElement = row.querySelector('.status'); // Elemen status
  statusElement.textContent = status; // Ubah teks status

  // Update class untuk styling status
  if (status === 'Processed') {
    statusElement.className = 'status processed';
  } else if (status === 'Resolved') {
    statusElement.className = 'status resolved';
  }
}