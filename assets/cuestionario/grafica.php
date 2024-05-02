<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encuesta de Satisfacción</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 30px;
      max-width: 600px; /* Ajustar el ancho máximo del contenedor para dispositivos móviles */
      margin-left: auto;
      margin-right: auto;
    }
    h1 {
      color: #1C3059;
    }
    .grafica {
      margin-top: 20px;
      max-width: 100%; /* Asegurar que la gráfica ocupe todo el ancho disponible */
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="mb-4">Encuesta de Satisfacción</h1>

    <!-- Div para mostrar la gráfica de barras -->
    <div class="grafica">
      <canvas id="grafica"></canvas>
    </div>

    <!-- Div para mostrar la gráfica de pastel -->
    <div class="grafica">
      <canvas id="grafica-pastel"></canvas>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let myBarChart;
      let myPieChart;

      // Generar respuestas aleatorias y generar gráficas
      generarRespuestas();
      generarGraficas();

      function generarRespuestas() {
        localStorage.setItem('respuesta1', Math.floor(Math.random() * 5) + 1);
        localStorage.setItem('respuesta2', Math.floor(Math.random() * 5) + 1);
        localStorage.setItem('respuesta3', Math.floor(Math.random() * 5) + 1);
      }

      function generarGraficas() {
        const respuesta1 = localStorage.getItem('respuesta1') || 0;
        const respuesta2 = localStorage.getItem('respuesta2') || 0;
        const respuesta3 = localStorage.getItem('respuesta3') || 0;

        const ctxBar = document.getElementById('grafica').getContext('2d');
        myBarChart = new Chart(ctxBar, {
          type: 'bar',
          data: {
            labels: ['Comodidad y limpieza', 'Tiempo de espera', 'Atención del doctor'],
            datasets: [{
              label: 'Satisfacción',
              data: [respuesta1, respuesta2, respuesta3],
              backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        const ctxPie = document.getElementById('grafica-pastel').getContext('2d');
        myPieChart = new Chart(ctxPie, {
          type: 'pie',
          data: {
            labels: ['Comodidad y limpieza', 'Tiempo de espera', 'Atención del doctor'],
            datasets: [{
              label: 'Satisfacción',
              data: [respuesta1, respuesta2, respuesta3],
              backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      }
    });
  </script>
</body>

</html>
