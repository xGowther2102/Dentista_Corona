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
        function obtenerHoraActual() {
    var ahora = new Date();
    var horas = ahora.getHours();
    var minutos = ahora.getMinutes();
    var ampm = horas >= 12 ? 'PM' : 'AM';
    
    // Convertir las horas al formato de 12 horas
    horas = horas % 12;
    horas = horas ? horas : 12; // La hora 0 debe ser 12

    // Añadir un cero delante de los minutos si es necesario
    minutos = minutos < 10 ? '0' + minutos : minutos;

    var horaActual = horas + ':' + minutos + ' ' + ampm;
    return horaActual;
}

console.log(obtenerHoraActual());

function obtenerFechaActual() {
    var ahora = new Date();
    var año = ahora.getFullYear();
    var mes = ahora.getMonth() + 1; // Los meses comienzan desde 0
    var dia = ahora.getDate();

    // Formatear la fecha como "YYYY-MM-DD"
    var fechaActual = año + '-' + (mes < 10 ? '0' + mes : mes) + '-' + (dia < 10 ? '0' + dia : dia);
    return fechaActual;
}

console.log(obtenerFechaActual());


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
                        // Acceder a la hora de cada cita y hacer lo que necesites con ella
                        console.log('Hora de la cita:', cita.hora);
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
    </script>
</body>
</html>
