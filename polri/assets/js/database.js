// polri/assets/js/database.js
function showNapiDetail(data) {
  console.log('Data received:', data); // Untuk debugging

  // Handle foto
  if (data.unggah_foto) {
      document.getElementById('modalFoto').src = data.unggah_foto;
      document.getElementById('modalFoto').style.display = 'block';
  } else {
      document.getElementById('modalFoto').style.display = 'none';
  }

  // Set semua data ke modal
  document.getElementById('modalId').textContent = data.id || '-';
  document.getElementById('modalNama').textContent = data.nama || '-';
  document.getElementById('modalNik').textContent = data.nik || '-';
  document.getElementById('modalIdNapi').textContent = data.id_napi || '-';
  document.getElementById('modalAlamat').textContent = data.alamat || '-';
  document.getElementById('modalTanggal').textContent = formatDate(data.tanggal_laporan);
  document.getElementById('modalLaporan').textContent = data.isi_laporan || '-';
}

function formatDate(dateString) {
  if (!dateString) return '-';
  try {
      const date = new Date(dateString);
      if (isNaN(date.getTime())) return '-';
      
      return date.toLocaleDateString('id-ID', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
      });
  } catch (e) {
      console.error('Error formatting date:', e);
      return dateString || '-';
  }
}

// Tambahkan event listener untuk debugging
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('detailModal');
  modal.addEventListener('show.bs.modal', function() {
      console.log('Modal is opening');
  });
});