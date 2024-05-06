<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gráficos de Barras</title>
    <!-- Incluir Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/graficas.css">
    <!-- Incluir html2canvas (versión más reciente compatible con Promises) -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.3.2/dist/html2canvas.min.js"></script>
    <?php require '../../css/grafica_css.php'; ?>
</head>
<main class="dark-mod">
    <div id="contenidoImprimir" class="container" style="max-width: 100%; margin: 30px auto;">
        <?php require '../../assets/graficas/obtener_datos_graficas.php'; ?>
        <h1 class="text-center mb-4">RESULTADOS DE ENCUESTA</h1>
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="grafica-container">
                    <canvas id="graficoComodidad"></canvas>
                </div>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="grafica-container">
                    <canvas id="graficoTiempo"></canvas>
                </div>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="grafica-container">
                    <canvas id="graficoAtencion"></canvas>
                </div>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <table class="table-custom">
                    <tbody>
                        <tr>
                            <td>Total de Encuestados</td>
                            <td><?php echo $total_encuestados; ?></td>
                        </tr>
                        <tr>
                            <td>Ultima vez</td>
                            <td><?php echo $ultimo_id; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container mt-5">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Guardar como Imagen</button>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modalImagen">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="descripcionModal">
                    ¿Estás seguro de que quieres guardar la página como imagen?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="imprimirPagina()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <!-- Incluir Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php require '../../js/graficas_js.php'; ?>
    <script>
        // Función para imprimir y guardar como imagen
        function imprimirPagina() {
            const contenidoParaImprimir = document.getElementById('contenidoImprimir');

            // Mantener el modo oscuro al capturar el contenido
            contenidoParaImprimir.classList.add('dark-mode');

            // Capturar el contenido del contenedor como una imagen
            html2canvas(contenidoParaImprimir).then(canvas => {
                // Crear un enlace para descargar la imagen
                const link = document.createElement('a');
                link.download = 'resultados_graficas.png'; // Nombre del archivo
                link.href = canvas.toDataURL(); // Convertir el canvas a un enlace de descarga
                link.click(); // Simular clic en el enlace para iniciar la descarga

                // Eliminar el modo oscuro después de la captura
                contenidoParaImprimir.classList.remove('dark-mode');
            });
        }
    </script>
</main>

</html>