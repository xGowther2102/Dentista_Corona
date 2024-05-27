<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Citas de Pacientes</h1>
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
                        FROM citas c INNER JOIN pacientes p ON c.pacientes_id = p.id;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $pacientes = [];
                    while ($row = $result->fetch_assoc()) {
                        $pacientes[] = $row;
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td>{$row['apellido_paterno']}</td>";
                        echo "<td>{$row['apellido_materno']}</td>";
                        echo "<td>{$row['antecedentes']}</td>";
                        echo "<td>{$row['estatus']}</td>";
                        echo "<td>{$row['tratamiento']}</td>";
                        echo "<td>{$row['fecha']}</td>";
                        echo "<td>{$row['hora']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No hay citas programadas</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Prueba SweetAlert2 -->
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        Swal.fire({
            title: 'Prueba',
            text: 'SweetAlert2 está funcionando correctamente.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
    </script>

    <script>
    const pacientes = <?php echo json_encode($pacientes); ?>;
    const citasNotificadas = new Set();

    function playNotificationSound() {
        const sound = document.getElementById('notification-sound');
        sound.play().catch(error => console.log('Error al reproducir el sonido:', error));
    }

    function mostrarNotificacion(paciente) {
        if (citasNotificadas.has(paciente.id)) {
            return;
        }
        console.log(`Mostrar notificación para ${paciente.nombre} ${paciente.apellido_paterno}`);
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
        console.log(`Mostrar opciones para ${paciente.nombre} ${paciente.apellido_paterno}`);

        if (citasNotificadas.has(paciente.id)) {
            return;
        }

        Swal.fire({
            title: 'Cita',
            text: `Seleccione una opción para la cita de ${paciente.nombre} ${paciente.apellido_paterno}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Completado',
            showDenyButton: true,
            denyButtonText: `Propuesto`,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                actualizarEstatus(paciente.id, 'COMPLETADO');
                citasNotificadas.add(paciente.id);
            } else if (result.isDenied) {
                proponerNuevaFechaHora(paciente);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                actualizarEstatus(paciente.id, 'CANCELADO');
                citasNotificadas.add(paciente.id);
            }
        });
    }

    function actualizarEstatus(id, estatus) {
        fetch('actualizar_estatus.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ pacientes_id: id, estatus: estatus })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                Swal.fire('Actualizado', 'El estatus ha sido actualizado.', 'success');
            } else {
                Swal.fire('Error', 'Hubo un problema al actualizar el estatus.', 'error');
            }
        });
    }

    function proponerNuevaFechaHora(paciente) {
        Swal.fire({
            title: 'Proponer nueva fecha y hora',
            html: '<input type="date" id="fecha" class="swal2-input">' +
                  '<input type="time" id="hora" class="swal2-input">',
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const fecha = Swal.getPopup().querySelector('#fecha').value;
                const hora = Swal.getPopup().querySelector('#hora').value;
                return { fecha: fecha, hora: hora };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const nuevaFechaHora = result.value;
                fetch('proponer_fecha_hora.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ pacientes_id: paciente.id, fecha: nuevaFechaHora.fecha, hora: nuevaFechaHora.hora })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        Swal.fire('Propuesto', 'La nueva fecha y hora han sido propuestas.', 'success');
                    } else {
                        Swal.fire('Error', 'Hubo un problema al proponer la nueva fecha y hora.', 'error');
                    }
                });
            }
        });
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
    </script>
</body>
</html>
