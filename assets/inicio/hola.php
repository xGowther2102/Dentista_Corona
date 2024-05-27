<?php
$servername = "localhost"; // Cambia esto por el nombre de tu servidor, generalmente es "localhost"
$username = "root";  // Cambia esto por tu nombre de usuario
$password = ""; // Cambia esto por tu contraseña
$dbname = "Dentista_Corona"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.4/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/tabla_citas.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php require '../../assets/MENU/index.php'; ?>
</head>
<style>
.estatus-pendiente {
    color: orange; /* Color para el estado pendiente */
}

.estatus-completado {
    color: green; /* Color para el estado completado */
}

.estatus-cancelado {
    color: red; /* Color para el estado cancelado */
}

</style>
<body>
    <main class="dark-mod">
   <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">CITAS SIGUIENTES</h1>
        <br>
        <button id="activar-notificaciones" class="btn btn-primary mb-3">Activar Notificaciones</button>
<div class="container mt-5">
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
                            case 'COMPLETADO':
                                $claseEstado = 'estatus-completado';
                                break;
                            case 'CANCELADO':
                                $claseEstado = 'estatus-cancelado';
                                break;
                            default:
                                break;
                        }
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td>{$row['apellido_paterno']}</td>";
                        echo "<td>{$row['apellido_materno']}</td>";
                        echo "<td>{$row['antecedentes']}</td>";
                        echo "<td class='$claseEstado'>{$row['estatus']}</td>";
                        echo "<td>{$row['tratamiento']}</td>";
                        echo "<td>{$row['fecha']}</td>";
                        echo "<td>{$row['hora']}</td>";
                        echo "<td class='d-flex justify-content-between'>";
                        echo "<button class='btn btn-danger btn-sm eliminar-btn' data-id='".$row['id']."'>Eliminar</button>";
                        echo "<button class='btn btn-primary btn-sm actualizar-btn' data-bs-toggle='modal' data-bs-target='#actualizarModal' data-id='".$row['id']."'>Actualizar</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No hay citas programadas</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
        <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#citasModal">
            Ver Citas
        </button>
    </main>
 <audio id="notification-sound" src="../../assets/panel_principal/sonido.mp3" preload="auto"></audio>
       <!-- Modal de Citas Pasadas -->
       <div class="modal fade" id="citasModal" tabindex="-1" aria-labelledby="citasModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="citasModalLabel">Citas Completadas y Canceladas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                include 'conexion.php';
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
                                        }
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['nombre']}</td>";
                                        echo "<td>{$row['apellido_paterno']}</td>";
                                        echo "<td>{$row['apellido_materno']}</td>";
                                        echo "<td>{$row['antecedentes']}</td>";
                                        echo "<td class='$claseEstado'>{$row['estatus']}</td>";
                                        echo "<td>{$row['tratamiento']}</td>";
                                        echo "<td>{$row['fecha']}</td>";
                                        echo "<td>{$row['hora']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No hay citas completadas o canceladas</td></tr>";
                                }
                                $conn->close();
                                ?>
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
                <form id="actualizarform">
                    <div class="mb-3">
                        <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombreCompleto" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="tratamiento" class="form-label">Tratamiento</label>
                        <input type="text" class="form-control" id="tratamiento" name="tratamient" required>
                    </div>
                    <div class="mb-3">
                        <label for="antecedentes" class="form-label">Antecedentes</label>
                        <input type="text" class="form-control" id="antecedentes" name="antecedente" required>
                    </div>
                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <select class="form-select" id="estatus" name="estatu" required>
                            <option value="">Seleccionar</option>
                            <option value="completado">Completado</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fechaHora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fechaHora" name="fechaHor" required>
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
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const pacientes = <?php echo json_encode($pacientes); ?>;
            const citasNotificadas = new Set();

            function playNotificationSound() {
                const sound = document.getElementById('notification-sound');
                sound.play().catch(error => console.log('Error al reproducir el sonido:', error));
            }
            function showAlert(paciente) {
            // Mostrar la alerta de SweetAlert
            Swal.fire({
                title: 'Aviso',
                text: `La cita de ${paciente.nombre} ${paciente.apellido_paterno} se aproxima.`,
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'OK'
            });

            if ('Notification' in window) {
            Notification.requestPermission().then(function(result) {
                if (result === 'granted') {
                new Notification('¡Hola!', {
                    body: `La cita de ${paciente.nombre} ${paciente.apellido_paterno} se aproxima.`
                });
                } else {
                console.error('Las notificaciones no están permitidas.');
                    }
                });
                } else {
                console.error('Las notificaciones no son compatibles con este navegador.');
                }
            }

            function mostrarNotificacion(paciente) {
                if (citasNotificadas.has(paciente.id)) {
                    return;
                }
                playNotificationSound();
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

            const btnActivarNotificaciones = document.getElementById('activar-notificaciones');
            btnActivarNotificaciones.addEventListener('click', function () {
                Notification.requestPermission().then(function (result) {
                    if (result === 'granted') {
                        Swal.fire('Notificaciones Activadas', 'Ahora recibirás notificaciones cuando se aproximen las citas.', 'success');
                    } else if (result === 'denied') {
                        Swal.fire('Notificaciones Bloqueadas', 'No has permitido las notificaciones en tu navegador.', 'warning');
                    }
                });
                btnActivarNotificaciones.disabled = true;
            });

            function showBrowserNotification() {
                const notification = new Notification('¡Notificación!', {
                    body: 'Esto es una alerta con sonido.'
                });

                notification.onshow = () => {
                    const audio = new Audio('beep-07.mp3');
                    audio.play();
                };
            }
        setInterval(showAlert, 5000);
        });
    </script>

    <script>
    $(document).ready(function() {
        $('.actualizar-btn').click(function() {
            var idCita = $(this).data('id');
            
            // Enviar solicitud AJAX para obtener los detalles de la cita
            $.ajax({
        type: 'POST',
        url: '../../assets/panel_principal/obtener_datos.php', // Script PHP para obtener detalles de la cita
        data: {
            id: idCita
        },
        success: function(response) {
            // Verificar si la respuesta contiene un error
            if (response.error) {
                console.error(response.error);
                return;
            }
            
            // Utilizar la respuesta JSON directamente
            var cita = response;

            // Llenar los campos del formulario con la información de la cita
            $('#nombreCompleto').val(cita.nombre + ' ' + cita.apellido_paterno + ' ' + cita.apellido_materno);
            $('#tratamiento').val(cita.tratamiento);
            $('#antecedentes').val(cita.antecedentes);
            $('#estatus').val(cita.estatus);
            $('#fechaHora').val(cita.fecha_hora);

            // Mostrar el modal
            $('#actualizarModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Manejar errores de AJAX (si es necesario)
            console.error(xhr.responseText);
        }
    });

        });
    });


    $(document).ready(function() {
        $('.citas-btn').click(function() {
            var idCita = $(this).data('id');
            
            // Enviar solicitud AJAX para obtener los detalles de la cita
            $.ajax({
        type: 'POST',
        url: '../../assets/panel_principal/obtener_datos.php', // Script PHP para obtener detalles de la cita
        data: {
            id: idCita
        },
        success: function(response) {
            // Verificar si la respuesta contiene un error
            if (response.error) {
                console.error(response.error);
                return;
            }
            
            // Utilizar la respuesta JSON directamente
            var cita = response;

            // Llenar los campos del formulario con la información de la cita
            $('#nombreCompleto').val(cita.nombre + ' ' + cita.apellido_paterno + ' ' + cita.apellido_materno);
            $('#tratamiento').val(cita.tratamiento);
            $('#antecedentes').val(cita.antecedentes);
            $('#estatus').val(cita.estatus);
            $('#fechaHora').val(cita.fecha_hora);

            // Mostrar el modal
            $('#citasPasadasModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Manejar errores de AJAX (si es necesario)
            console.error(xhr.responseText);
        }
    });

        });
    });
    </script>
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
    <script src="../../js/eliminar_principal.js"></script>
  <!--  <script src="../../assets/panel_principal/JS/Actualizar.js"></script>--->
</body>

</html>
