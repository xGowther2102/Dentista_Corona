<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL PRINCIPAL</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.4/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/tabla_citas.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php require '../../assets/MENU/index.php'; ?>
</head>

<body>
    <main class="dark-mod">
        <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">CITAS SIGUIENTES</h1>
        <br>
        <div class="container">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead id="tabla_1">
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Tratamiento</th>
                            <th>Antecedentes</th>
                            <th>Estatus</th>
                            <th>Fecha y hora</th>
                            <th>Acciones</th> <!-- Nueva columna para acciones -->
                        </tr>
                    </thead>
                    <tbody id="resultados_tabla">
                        <!-- Filas de la tabla con botones de Eliminar y Actualizar -->
                        <tr>
                            <td>Maria Pérez</td>
                            <td>Doctora</td>
                            <td>Diente picado</td>
                            <td>Pendiente</td>
                            <td>2023-01-15</td>
                            <td>
                                <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                                <button class="btn btn-primary btn-sm actualizar-btn" data-bs-toggle="modal" data-bs-target="#actualizarModal">Actualizar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Juan García</td>
                            <td>Enfermero</td>
                            <td>Caries</td>
                            <td>Pendiente</td>
                            <td>2023-01-20</td>
                            <td>
                                <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                                <button class="btn btn-primary btn-sm actualizar-btn" data-bs-toggle="modal" data-bs-target="#actualizarModal">Actualizar</button>
                            </td>
                        </tr>
                        <!-- Repite estas filas para cada dato -->
                    </tbody>
                </table>
            </div>
            <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        </div>
        <button class="btn btn-primary btn-sm " id="citas-pasadas-btn">CITAS PASADAS</button>
    </main>

    <!-- Modal de Citas Pasadas -->
    <div class="modal fade" id="citasPasadasModal" tabindex="-1" aria-labelledby="citasPasadasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="citasPasadasModalLabel">Citas Pasadas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Tratamiento</th>
                                <th>Antecedentes</th>
                                <th>Estatus</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody id="citas-pasadas-tabla">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para actualizar cita -->
    <div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dark">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="actualizarModalLabel">Actualizar Cita</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario-actualizar">
                        <div class="mb-3">
                            <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" required value="Juan García">
                        </div>
                        <div class="mb-3">
                            <label for="tratamiento" class="form-label">Tratamiento</label>
                            <input type="text" class="form-control" id="tratamiento" name="tratamiento" required value="Enfermero">
                        </div>
                        <div class="mb-3">
                            <label for="antecedentes" class="form-label">Antecedentes</label>
                            <input type="text" class="form-control" id="antecedentes" name="antecedentes" required value="Caries">
                        </div>
                        <div class="mb-3">
                            <label for="estatus" class="form-label">Estatus</label>
                            <select class="form-select" id="estatus" name="estatus" required>
                                <option value="">Seleccionar</option>
                                <option value="completado">Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaHora" class="form-label">Fecha y Hora</label>
                            <input type="text" class="form-control" id="fechaHora" name="fechaHora" required value="2022-06-20">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- FileSaver.js para descarga de Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <!-- Script para actualizar filas y exportar a Excel -->
    <script src="../../js/tabla_citas.js"></script>
    <script>
        // Función para filtrar citas pasadas y mostrarlas en el modal
        $(document).on('click', '#citas-pasadas-btn', function() {
            $('#citasPasadasModal').modal('show');
            // Agregar la lógica para llenar la tabla de citas pasadas aquí
            $('#citas-pasadas-tabla').empty(); // Limpiar la tabla antes de agregar nuevas filas

            // Aquí debes hacer una solicitud AJAX para obtener los datos de las citas pasadas desde tu servidor
            $.ajax({
                url: 'obtener_citas_pasadas.php', // URL del script PHP que obtiene los datos de las citas pasadas
                type: 'GET',
                success: function(response) {
                    // La respuesta debe ser un array de objetos JSON con los datos de las citas pasadas
                    var citasPasadas = JSON.parse(response);
                    citasPasadas.forEach(function(cita) {
                        var estatusColor = cita.estatus === 'Completado' ? 'text-success' : 'text-danger'; // Color verde para completado, rojo para pendiente
                        $('#citas-pasadas-tabla').append(`
                            <tr>
                                <td>${cita.nombreCompleto}</td>
                                <td>${cita.tratamiento}</td>
                                <td>${cita.antecedentes}</td>
                                <td class="${estatusColor}">${cita.estatus}</td>
                                <td>${cita.fechaHora}</td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener las citas pasadas:', error);
                }
            });
        });

        // Función para mostrar alerta 5 minutos antes de la hora de la cita
        function mostrarAlertaProximaCita() {
            // Obtener la hora actual
            var horaActual = new Date();
            // Sumar 5 minutos a la hora actual
            horaActual.setMinutes(horaActual.getMinutes() + 5);
            // Mostrar la alerta
            Swal.fire({
                icon: 'info',
                title: 'Recordatorio de Cita',
                text: 'Tu cita está próxima, por favor prepárate.',
                timer: 5000 // Duración de la alerta en milisegundos (5 segundos)
            });
        }

        // Función para mostrar alerta al llegar la hora de la cita
        function mostrarAlertaHoraCita() {
            Swal.fire({
                title: '¿Qué deseas hacer con la cita?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Completado',
                denyButtonText: 'Propuesto',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lógica si se marca como completado
                    Swal.fire('¡Cita marcada como completada!', '', 'success');
                } else if (result.isDenied) {
                    // Lógica si se marca como propuesto
                    Swal.fire('¡Cita marcada como propuesta!', '', 'info');
                } else {
                    // Lógica si se cancela la cita
                    Swal.fire('¡Cita cancelada!', '', 'error');
                }
            });
        }

        // Programar alerta para 5 minutos antes de la hora de la cita
        setTimeout(mostrarAlertaProximaCita, 300000); // 5 minutos antes (300,000 milisegundos)

        // Programar alerta para la hora de la cita
        setTimeout(mostrarAlertaHoraCita, 600000); // Hora de la cita (600,000 milisegundos = 10 minutos)
    </script>
</body>

</html>
