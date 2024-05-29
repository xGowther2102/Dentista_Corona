<?php
include 'conexion.php';
session_start();
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
} else {
    header("../sesion.php");
    exit();
}

// Obtener el ID del usuario basado en el correo electrónico
$sql_usuario = "SELECT id FROM usuarios WHERE correo = '$correo'";
$result_usuario = $conn->query($sql_usuario);

if ($result_usuario->num_rows > 0) {
    $row_usuario = $result_usuario->fetch_assoc();
    $usuario_id = $row_usuario['id'];
} else {
    echo "Usuario no encontrado.";
    exit();
}
echo $usuario_id;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluir jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Incluir Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Incluir Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                    <th>Acciones</th> <!-- Nueva columna para acciones -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.estatus, c.tratamiento, c.fecha, c.hora
                        FROM citas c 
                        INNER JOIN pacientes p ON c.pacientes_id = p.id
                        WHERE c.usuario_id = $usuario_id";
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
                        echo "<td>"; // Abre la columna de acciones
                        echo "<button class='btn btn-primary btn-sm' onclick='mostrarModalActualizar({$row['id']})'>Actualizar</button>";
                        echo "<button class='btn btn-danger btn-sm ms-2' onclick='mostrarModalEliminar({$row['id']})'>Eliminar</button>";
                        echo "</td>"; // Cierra la columna de acciones
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

    <div class="modal fade" id="modalCita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Estado de la Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Seleccione una opción para actualizar el estado de la cita.</p>
                    <button class="btn btn-primary" onclick="actualizarEstadoCita(citaId, 'COMPLETADO')">Completado</button>
                    <button class="btn btn-secondary" onclick="mostrarModalPropuesto(citaId)">Propuesto</button>
                    <button class="btn btn-danger" onclick="actualizarEstadoCita(citaId, 'CANCELADO')">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modales de SweetAlert2 -->
    <script>
    function mostrarModalActualizar(id) {
        fetch(`obtener_cita.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: 'Actualizar Cita',
                    html: `
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="nombre" class="swal2-input" placeholder="Nombre" value="${data.nombre}">
                                    <input type="text" id="apellido_paterno" class="swal2-input" placeholder="Apellido Paterno" value="${data.apellido_paterno}">
                                    <input type="text" id="apellido_materno" class="swal2-input" placeholder="Apellido Materno" value="${data.apellido_materno}">
                                    <input type="text" id="antecedentes" class="swal2-input" placeholder="Antecedentes" value="${data.antecedentes}">
                                </div>
                                <div class="col">
                                    <input type="text" id="estatus" class="swal2-input" placeholder="Estatus" value="${data.estatus}">
                                    <input type="text" id="tratamiento" class="swal2-input" placeholder="Tratamiento" value="${data.tratamiento}">
                                    <input type="date" id="fecha" class="swal2-input" value="${data.fecha}">
                                    <input type="time" id="hora" class="swal2-input" value="${data.hora}">
                                </div>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar',
                    preConfirm: () => {
                        return {
                            nombre: document.getElementById('nombre').value,
                            apellido_paterno: document.getElementById('apellido_paterno').value,
                            apellido_materno: document.getElementById('apellido_materno').value,
                            antecedentes: document.getElementById('antecedentes').value,
                            estatus: document.getElementById('estatus').value,
                            tratamiento: document.getElementById('tratamiento').value,
                            fecha: document.getElementById('fecha').value,
                            hora: document.getElementById('hora').value
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const updatedData = {
                            id: id,
                            ...result.value
                        };

                        fetch('actualizar_citas.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(updatedData)
                        }).then(response => response.json()).then(data => {
                            if (data.success) {
                                Swal.fire('Actualizado', 'La cita ha sido actualizada.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', 'Hubo un problema al actualizar la cita.', 'error');
                            }
                        });
                    }
                });
            });
    }

    function mostrarModalEliminar(id) {
        Swal.fire({
            title: 'Eliminar Cita',
            text: '¿Estás seguro de que deseas eliminar esta cita?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, Eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d33',
            dangerMode: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('eliminar_cita.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        Swal.fire('Eliminado', 'La cita ha sido eliminada.', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Hubo un problema al eliminar la cita.', 'error');
                    }
                });
            }
        });
    }
    </script>

<script>
     $(document).ready(function() {
        // Obtener el ID del usuario desde PHP
        var usuario_id = <?php echo $usuario_id; ?>;

        // Función para obtener las citas del usuario activo
        function obtenerCitasUsuarioActivo() {
            // Realizar la solicitud AJAX
            $.ajax({
                url: 'obtener_cita.php', // Ruta a tu script PHP que maneja la solicitud
                type: 'POST',
                dataType: 'json',
                data: { usuario_id: usuario_id },
                success: function(response) {
                    // Manejar la respuesta del servidor
                    if (response.success) {
                        // Aquí puedes trabajar con los datos de las citas recibidas
                        var citas = response.citas;
                        citas.forEach(function(cita) {
                            // Obtener la fecha y hora actual
                            var fechaActual = new Date();

                            // Convertir la hora de la cita a formato de 24 horas
                            var horaCita24 = convertirHora(cita.hora);
                            console.log('Hora de la Cita:', horaCita24);

                            // Calcular la hora final sumando la duración
                            var horaFinal = calcularHoraFinal(horaCita24, cita.duracion);
                            console.log('Hora Final:', horaFinal);

                            // Convertir horas de cita y hora final a objetos Date
                            var horaInicio = convertirAFecha(cita.fecha, horaCita24);
                            var horaFin = convertirAFecha(cita.fecha, horaFinal);

                            // Calcular 5 minutos antes de la hora de inicio y 5 minutos después de la hora final
                            var cincoMinAntesInicio = new Date(horaInicio.getTime() - 5 * 60000);
                            console.log(cincoMinAntesInicio);
                            var cincoMinDespuesFin = new Date(horaFin.getTime() + 5 * 60000);
                            console.log(cincoMinDespuesFin);
                            // Verificar si la hora actual está dentro de los intervalos
                            // Verificar si la hora actual está dentro de los intervalos
                            if (fechaActual >= cincoMinAntesInicio && fechaActual < horaInicio) {
                                // Mostrar mensaje de aproximación de cita
                                alert('La cita se aproxima en los próximos 5 minutos.');
                            } else if (fechaActual >= horaFin && fechaActual <= cincoMinDespuesFin) {
                                // Mostrar el modal 5 minutos después de la hora final
                                setTimeout(function() {
                                    mostrarModal(cita.id, 'La cita ha finalizado.');
                                }, 5 * 60000); // Esperar 5 minutos después de la hora final
                            }
                        });
                    } else {
                        console.error('Error al obtener citas:', response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }

        // Llamar a la función para obtener las citas del usuario activo
        obtenerCitasUsuarioActivo();
    });

    function obtenerFechaActual() {
        var ahora = new Date();
        var año = ahora.getFullYear();
        var mes = ahora.getMonth() + 1; // Los meses comienzan desde 0
        var dia = ahora.getDate();

        // Formatear la fecha como "YYYY-MM-DD"
        var fechaActual = año + '-' + (mes < 10 ? '0' + mes : mes) + '-' + (dia < 10 ? '0' + dia : dia);
        return fechaActual;
    }

    function convertirHora(hora24) {
        var partesHora = hora24.split(':');
        var horas = parseInt(partesHora[0]);
        var minutos = partesHora[1];
        return horas + ':' + minutos;
    }

    function calcularHoraFinal(horaInicio, duracion) {
        var partesInicio = horaInicio.split(':');
        var horasInicio = parseInt(partesInicio[0]);
        var minutosInicio = parseInt(partesInicio[1]);

        var partesDuracion = duracion.split(':');
        var horasDuracion = parseInt(partesDuracion[0]);
        var minutosDuracion = parseInt(partesDuracion[1]);

        var horasFinal = horasInicio + horasDuracion;
        var minutosFinal = minutosInicio + minutosDuracion;

        if (minutosFinal >= 60) {
            horasFinal += 1;
            minutosFinal -= 60;
        }

        return (horasFinal < 10 ? '0' + horasFinal : horasFinal) + ':' + (minutosFinal < 10 ? '0' + minutosFinal : minutosFinal);
    }

    function convertirAFecha(fecha, hora) {
        var partesFecha = fecha.split('-');
        var partesHora = hora.split(':');
        var anio = parseInt(partesFecha[0]);
        var mes = parseInt(partesFecha[1]) - 1; // Los meses en JavaScript van de 0 a 11
        var dia = parseInt(partesFecha[2]);
        var horas = parseInt(partesHora[0]);
        var minutos = parseInt(partesHora[1]);
        return new Date(anio, mes, dia, horas, minutos);
    }

    function mostrarModal(citaId, mensaje) {
        // Crear el modal dinámicamente
        var modalHtml = `
            <div id="modalCita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar Estado de la Cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>${mensaje}</p>
                            <button class="btn btn-primary" onclick="actualizarEstadoCita(${citaId}, 'COMPLETADO')">Completado</button>
                            <button class="btn btn-secondary" onclick="mostrarModalPropuesto(${citaId})">Propuesto</button>
                            <button class="btn btn-danger" onclick="actualizarEstadoCita(${citaId}, 'CANCELADO')">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('body').append(modalHtml);
        $('#modalCita').modal('show');
    }

    function mostrarModalPropuesto(citaId) {
        // Crear el modal para actualizar la hora y fecha
        var modalHtml = `
            <div id="modalPropuesto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Proponer Nueva Hora y Fecha</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="date" id="nuevaFecha" class="form-control">
                            <input type="time" id="nuevaHora" class="form-control mt-2">
                            <button class="btn btn-primary mt-2" onclick="actualizarEstadoPropuesto(${citaId})">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('body').append(modalHtml);
        $('#modalPropuesto').modal('show');
    }

    function actualizarEstadoCita(citaId, nuevoEstado) {
        $.ajax({
            url: 'actualizar_estado.php',
            type: 'POST',
            data: { id: citaId, estado: nuevoEstado },
            success: function(response) {
                if (response.success) {
                    alert('El estado de la cita ha sido actualizado.');
                    $('#modalCita').modal('hide');
                } else {
                    alert('Error al actualizar el estado de la cita.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    }

    function actualizarEstadoPropuesto(citaId) {
        var nuevaFecha = $('#nuevaFecha').val();
        var nuevaHora = $('#nuevaHora').val();

        $.ajax({
            url: 'actualizar_estatus.php',
            type: 'POST',
            data: { id: citaId, estado: 'PENDIENTE', fecha: nuevaFecha, hora: nuevaHora },
            success: function(response) {
                if (response.success) {
                    alert('El estado de la cita ha sido actualizado.');
                    $('#modalPropuesto').modal('hide');
                } else {
                    alert('Error al actualizar el estado de la cita.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    }
    </script>


</body>
</html>
