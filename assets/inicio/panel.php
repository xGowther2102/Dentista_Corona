<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dentista_Corona";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/tabla_citas.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/eliminar_principal.js"></script>
</head>
<style>
    @media (max-width: 768px) {

        /* Estilos para dispositivos móviles */
        .table-responsive {
            overflow-x: auto;
        }
    }

    .dark-mode .estatus-pendiente {
        color: orange;
        /* Color para el estado pendiente */
    }

    .dark-mode .estatus-completado {
        color: green;
        /* Color para el estado completado */
    }

    .dark-mode .estatus-cancelado {
        color: red;
        /* Color para el estado cancelado */
    }
</style>

<body>
    <?php require '../../assets/MENU/index.php'; ?>
    <main class="dark-mod">
        <h1 class="my-4 text-center text-secondary">CITAS SIGUIENTES</h1>
        <br>
        <button id="activar-notificaciones" class="btn btn-primary mb-3">Activar Notificaciones</button>
        <div class="container mt-5 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Antecedentes</th>
                        <th>Estatus</th>
                        <th>Tratamiento</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.estatus, c.tratamiento, c.fecha, c.hora
                            FROM citas c INNER JOIN pacientes p ON c.pacientes_id = p.id
                            WHERE c.estatus IN ('PENDIENTE');";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $pacientes = [];
                        while ($row = $result->fetch_assoc()) {
                            $pacientes[] = $row;
                            switch ($row['estatus']) {
                                case 'PENDIENTE':
                                    $claseEstado = 'estatus-pendiente';
                                    break;
                                default:
                                    $claseEstado = '';
                                    break;
                            }
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['nombre']}</td>";
                            echo "<td>{$row['apellido_paterno']}</td>";
                            echo "<td>{$row['apellido_materno']}</td>";
                            echo "<td>{$row['antecedentes']}</td>";
                            echo "<td class='estatus $claseEstado'>{$row['estatus']}</td>";
                            echo "<td>{$row['tratamiento']}</td>";
                            echo "<td>{$row['fecha']}</td>";
                            echo "<td>{$row['hora']}</td>";
                            echo "<td class='d-flex justify-content-between'>";
                            echo "<button class='btn btn-danger btn-sm eliminar-btn' data-id='" . $row['id'] . "'>Eliminar</button>";
                            echo "<button class='btn btn-primary btn-sm actualizar-btn' data-bs-toggle='modal' data-bs-target='#actualizarModal' data-id='" . $row['id'] . "'>Actualizar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No hay citas programadas</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#citasModal">Ver Citas Pasadas</button>
    </main>
    <audio id="notification-sound" src="../../assets/panel_principal/sonido.mp3" preload="auto"></audio>

    <!-- Modal de Citas Pasadas -->
    <div class="modal fade" id="citasModal" tabindex="-1" aria-labelledby="citasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="citasModalLabel">Citas Completadas y Canceladas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Antecedentes</th>
                                    <th>Estatus</th>
                                    <th>Tratamiento</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.estatus, c.tratamiento, c.fecha, c.hora
                                        FROM citas c INNER JOIN pacientes p ON c.pacientes_id = p.id
                                        WHERE c.estatus IN ('COMPLETADO', 'CANCELADO');";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $claseEstado = '';
                                        switch ($row['estatus']) {
                                            case 'COMPLETADO':
                                                $claseEstado = 'estatus-completado';
                                                break;
                                            case 'CANCELADO':
                                                $claseEstado = 'estatus-cancelado';
                                                break;
                                            default:
                                                $claseEstado = '';
                                                break;
                                        }
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['nombre']}</td>";
                                        echo "<td>{$row['apellido_paterno']}</td>";
                                        echo "<td>{$row['apellido_materno']}</td>";
                                        echo "<td>{$row['antecedentes']}</td>";
                                        echo "<td class='estatus $claseEstado'>{$row['estatus']}</td>";
                                        echo "<td>{$row['tratamiento']}</td>";
                                        echo "<td>{$row['fecha']}</td>";
                                        echo "<td>{$row['hora']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No hay citas completadas o canceladas</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
                    <form id="actualizarform">
                        <div class="mb-3">
                            <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombreCompleto" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="tratamiento" class="form-label">Tratamiento</label>
                            <input type="text" class="form-control" id="tratamiento" name="tratamiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="estatus" class="form-label">Estatus</label>
                            <input type="text" class="form-control" id="estatus" name="estatus" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                        <input type="hidden" id="actualizarId" name="id">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();

            $('.actualizar-btn').on('click', function() {
                var id = $(this).data('id');
                console.log(id);
                var pacientes = <?php echo json_encode($pacientes); ?>;
                var paciente = pacientes.find(p => p.id == id);
                if (paciente) {
                    $('#actualizarId').val(paciente.id);
                    $('#nombreCompleto').val(paciente.nombre + ' ' + paciente.apellido_paterno + ' ' + paciente.apellido_materno);
                    $('#tratamiento').val(paciente.tratamiento);
                    $('#estatus').val(paciente.estatus);
                    $('#fecha').val(paciente.fecha);
                    $('#hora').val(paciente.hora);
                }
            });

            $('#actualizarform').on('submit', function(e) {
                e.preventDefault();
                var id = $('#actualizarId').val();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '../../assets/panel_principal/actualizar_cita.php',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cita actualizada',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al actualizar',
                            text: 'No se pudo actualizar la cita. Inténtelo de nuevo.'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.eliminar-btn').click(function() {
                var idCita = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '../../assets/inicio/eliminar_cita.php', // URL de tu script PHP para eliminar
                            data: {
                                id: idCita
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Eliminado',
                                    'La cita ha sido eliminada.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error',
                                    'Se produjo un error al eliminar la cita.',
                                    'error'
                                );
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        //     $(document).ready(function() {
        //     $('.table').DataTable();
        // });

        document.addEventListener('DOMContentLoaded', function() {
            const pacientes = <?php echo json_encode($pacientes); ?>;
            const citasNotificadas = new Set();

            // function playNotificationSound() {
            //     const sound = document.getElementById('notification-sound');
            //     sound.play().catch(error => console.log('Error al reproducir el sonido:', error));
            // }

            function mostrarNotificacion(paciente) {
                if (citasNotificadas.has(paciente.id)) {
                    return;
                }
                //playNotificationSound();
                Swal.fire({
                    title: 'Aviso',
                    text: `La cita de ${paciente.nombre} ${paciente.apellido_paterno} se aproxima.`,
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'OK'
                }).then(() => {
                    citasNotificadas.add(paciente.id);
                });
            }

            function mostrarModalOpciones(paciente) {
                // Verifica si el estado de la cita no es completado
                if (paciente.estatus !== 'COMPLETADO' && paciente.estatus !== 'CANCELADO') {
                    Swal.fire({
                        title: 'Cita',
                        text: `Seleccione una opción para la cita de ${paciente.nombre} ${paciente.apellido_paterno}`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Completado',
                        showDenyButton: true,
                        denyButtonText: `Propuesto`,
                        cancelButtonText: 'Cancelar Cita'
                    }).then((result) => {
                        citasNotificadas.add(paciente.id);
                        if (result.isConfirmed) {
                            actualizarEstatus(paciente.id, 'COMPLETADO');
                        } else if (result.isDenied) {
                            proponerNuevaFechaHora(paciente);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            actualizarEstatus(paciente.id, 'CANCELADO');
                        }
                    });
                } else {
                    citasNotificadas.add(paciente.id); // Agregar la cita a citasNotificadas
                }
            }

            function verificarCitas() {
                const ahora = new Date();
                console.log(ahora);
                pacientes.forEach(paciente => {
                    const horaCita = new Date(`${paciente.fecha}T${paciente.hora}`);
                    const cincoMinAntes = new Date(horaCita.getTime() - 5 * 60000);
                    const cincoMinDespues = new Date(horaCita.getTime() + 5 * 60000);

                    if (ahora >= cincoMinAntes && ahora < horaCita) {
                        mostrarNotificacion(paciente);
                    } else if (ahora >= horaCita && ahora < cincoMinDespues) {
                        mostrarModalOpciones(paciente);
                    }
                });
            }

            setInterval(verificarCitas, 60000);
        });
    </script>
</body>

</html>

<?php $conn->close(); ?>