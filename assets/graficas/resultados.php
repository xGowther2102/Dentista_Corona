<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gráficos de Barras</title>
    <!-- Incluir Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/graficas.css">
    <style>
        /* Estilos para las gráficas */
        .grafica-container {
            margin-bottom: 15px;
            /* Espacio entre las gráficas */
        }

        .grafica-container canvas {
            border: 2.5px solid rgba(0, 0, 0, 0.3);
            background-color: rgba(0, 0, 0, 0.025);
            /* Color y estilo del borde */
            border-radius: 8px;
            /* Borde redondeado */
        }

        .dark-mode .grafica-container {
            margin-bottom: 15px;
            /* Espacio entre las gráficas */
            /* Color y estilo del borde */
            color: #fff;
        }

        .dark-mode .grafica-container canvas {
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: #fff;
            background-color: rgba(255, 255, 255, 0.025);
        }
    </style>
</head>

<main class="dark-mod">
    <div class="container">
        <?php require '../../assets/graficas/obtener_datos_graficas.php'; ?>
        <div class="row grafica-container">
            <div class="col-md-12 col-lg-4">
                <canvas id="graficoComodidad" style="width: 60%; height: auto;"></canvas>
            </div>
            <div class="col-md-12 col-lg-4">
                <canvas id="graficoTiempo" style="width: 60%; height: auto;"></canvas>
            </div>
            <div class="col-md-12 col-lg-4">
                <canvas id="graficoAtencion" style="width: 60%; height: auto;"></canvas>
            </div>
        </div>
    </div>

    <!-- Incluir Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <!-- Incluir Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Datos para los gráficos
        var ctxComodidad = document.getElementById('graficoComodidad').getContext('2d');
        var ctxTiempo = document.getElementById('graficoTiempo').getContext('2d');
        var ctxAtencion = document.getElementById('graficoAtencion').getContext('2d');

        var dataComodidad = {
            labels: ['Insatisfecho', 'Poco satisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'],
            datasets: [{
                label: 'Niveles de Satisfacción - Comodidad y Limpieza',
                data: [<?php echo implode(',', $nivelesComodidad); ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        var dataTiempo = {
            labels: ['Insatisfecho', 'Poco satisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'],
            datasets: [{
                label: 'Niveles de Satisfacción - Tiempo de Espera',
                data: [<?php echo implode(',', $nivelesTiempo); ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        var dataAtencion = {
            labels: ['Insatisfecho', 'Poco satisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'],
            datasets: [{
                label: 'Niveles de Satisfacción - Atención del Doctor',
                data: [<?php echo implode(',', $nivelesAtencion); ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                x: {
                    ticks: {
                        color: 'green' // Cambiar el color de los labels del eje X
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20,
                        callback: function(value) {
                            return value + '%';
                        },
                        color: 'green' // Cambiar el color de los labels del eje X
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '',
                    color: 'red' // Cambiar el color del título de la gráfica
                }
            }
        };

        // Crear los gráficos de barras
        var graficoComodidad = new Chart(ctxComodidad, {
            type: 'bar',
            data: dataComodidad,
            options: Object.assign({}, options, {
                plugins: {
                    title: {
                        text: 'Niveles de Satisfacción - Comodidad y Limpieza',
                        color: 'orange' // Cambiar el color del título de la gráfica
                    }
                }
            })
        });

        var graficoTiempo = new Chart(ctxTiempo, {
            type: 'bar',
            data: dataTiempo,
            options: Object.assign({}, options, {
                plugins: {
                    title: {
                        text: 'Niveles de Satisfacción - Tiempo de Espera',
                        color: 'purple' // Cambiar el color del título de la gráfica
                    }
                }
            })
        });

        var graficoAtencion = new Chart(ctxAtencion, {
            type: 'bar',
            data: dataAtencion,
            options: Object.assign({}, options, {
                plugins: {
                    title: {
                        text: 'Niveles de Satisfacción - Atención del Doctor',
                        color: 'green' // Cambiar el color del título de la gráfica
                    }
                }
            })
        });
    </script>
</main>

</html>