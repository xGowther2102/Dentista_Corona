<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resultados de Encuesta</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h1 class="mt-5 mb-4">Resultados de Encuesta</h1>
  <div class="row">
    <div class="col-md-6">
      <h2>Gráfico de Barras</h2>
      <canvas id="barChart" width="400" height="200"></canvas>
    </div>
    <div class="col-md-6">
      <h2>Gráfico de Pastel</h2>
      <canvas id="pieChart" width="400" height="200"></canvas>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<!-- Custom JavaScript -->
<script>
  // Obtener los datos del backend utilizando Fetch API
  fetch('obtener_datos_graficas.php')
    .then(response => response.json())
    .then(data => {
      // Procesar los datos obtenidos y actualizar las gráficas
      const datosBarras = {
        labels: data.map(item => item.respuesta),
        datasets: [{
          label: 'Comodidad y Limpieza',
          data: data.map(item => item.cantidad),
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
          ],
          borderWidth: 1
        }]
      };

      // Configuración de la gráfica de barras
      const configBarras = {
        type: 'bar',
        data: datosBarras,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };

      // Crear la gráfica de barras
      const barChart = new Chart(document.getElementById('barChart'), configBarras);
    })
    .catch(error => {
      console.error('Error al obtener datos del backend:', error);
    });
</script>

</body>
</html>
