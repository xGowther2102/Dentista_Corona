<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página con Bootstrap 5 y Chart.js</title>
  <!-- Enlace a Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Enlace a Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Estilos personalizados -->
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
    }
    h1 {
      color: #1C3059;
    }
    .table-container {
      max-height: 300px;
      overflow-y: auto;
    }
    #grafica {
      height: 300px;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="mb-4">Tabla de Datos Temporales</h1>
    
    <!-- Botón para agregar datos a la tabla -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#agregarDatoModal">Agregar Dato</button>
    
    <!-- Contenedor de la tabla -->
    <div class="table-container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Valor</th>
          </tr>
        </thead>
        <tbody id="tablaDatos">
          <!-- Aquí se generará la tabla dinámicamente -->
        </tbody>
      </table>
    </div>

    <!-- Modal para agregar datos -->
    <div class="modal fade" id="agregarDatoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Dato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Formulario para agregar datos -->
            <form id="formularioDato">
              <div class="mb-3">
                <label for="nombreDato" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreDato" required>
              </div>
              <div class="mb-3">
                <label for="valorDato" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valorDato" required>
              </div>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón para generar gráfica -->
    <button type="button" class="btn btn-success mt-3" id="generarGraficaBtn">Generar Gráfica</button>

    <!-- Div para mostrar la gráfica -->
    <canvas id="grafica" class="mt-4"></canvas>
  </div>

  <!-- Enlace a Bootstrap JS (popper.js y Bootstrap bundle) y jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <!-- Script personalizado -->
  <script>
    $(document).ready(function() {
      let datosTemporales = [];

      // Función para agregar datos a la tabla
      $("#formularioDato").submit(function(e) {
        e.preventDefault();
        let nombre = $("#nombreDato").val();
        let valor = $("#valorDato").val();
        datosTemporales.push({ nombre, valor });
        actualizarTabla();
        $("#agregarDatoModal").modal("hide");
        $("#nombreDato").val("");
        $("#valorDato").val("");
      });

      // Función para actualizar la tabla
      function actualizarTabla() {
        $("#tablaDatos").empty();
        datosTemporales.forEach((dato, index) => {
          $("#tablaDatos").append(`<tr><td>${index + 1}</td><td>${dato.nombre}</td><td>${dato.valor}</td></tr>`);
        });
      }

      // Evento clic para generar gráfica
      $("#generarGraficaBtn").click(function() {
        generarGrafica();
      });

      // Función para generar la gráfica
      function generarGrafica() {
        let labels = [];
        let valores = [];
        datosTemporales.forEach((dato) => {
          labels.push(dato.nombre);
          valores.push(dato.valor);
        });

        // Configuración de la gráfica
        var ctx = document.getElementById('grafica').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Valores',
              data: valores,
              backgroundColor: 'rgba(54, 162, 235, 0.5)',
              borderColor: 'rgba(54, 162, 235, 1)',
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
