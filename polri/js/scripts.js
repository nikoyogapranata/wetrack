// Inisialisasi Grafik Menggunakan Chart.js
const ctx = document.getElementById('myChart').getContext('2d');

const myChart = new Chart(ctx, {
  type: 'line', // Menggunakan grafik garis
  data: {
    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
    datasets: [{
      label: 'Tracked Individuals',
      data: [1200, 1250, 1300, 1320, 1350, 1380, 1365],
      borderColor: 'blue',
      borderWidth: 2,
      fill: false
    }, {
      label: 'Successful Registrations',
      data: [120, 130, 140, 145, 150, 155, 152],
      borderColor: 'green',
      borderWidth: 2,
      fill: false
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});