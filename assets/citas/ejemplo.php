<?php
session_start(); // Iniciar sesión (asegúrate de llamar a esto antes de imprimir cualquier salida HTML)

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['paciente_id'])) {
    // Redirigir a la página de inicio de sesión si el usuario no está autenticado
    header("Location: iniciar_sesion.php");
    exit();
}

// Obtener el ID del paciente desde la sesión
$paciente_id = $_SESSION['paciente_id'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nombre_de_la_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener las citas y pacientes
$sql = "SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.id AS cita_id, c.estatus, c.tratamiento, c.fecha, c.hora
FROM citas c INNER JOIN pacientes p ON c.pacientes_id = p.id WHERE p.id = $paciente_id";
$result = $conn->query($sql);

$citas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

// Consulta para obtener los tratamientos del paciente
$tratamientos_sql = "SELECT id, nombre, duracion FROM tratamientos WHERE paciente_id = $paciente_id";
$tratamientos_result = $conn->query($tratamientos_sql);
$tratamientos = [];
if ($tratamientos_result->num_rows > 0) {
    while($row = $tratamientos_result->fetch_assoc()) {
        $tratamientos[$row['id']] = $row['duracion'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Citas</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <table border="1">
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
        <?php foreach ($citas as $cita): ?>
        <tr>
            <td><?php echo $cita['id']; ?></td>
            <td><?php echo $cita['nombre']; ?></td>
            <td><?php echo $cita['apellido_paterno']; ?></td>
            <td><?php echo $cita['apellido_materno']; ?></td>
            <td><?php echo $cita['antecedentes']; ?></td>
            <td><?php echo $cita['estatus']; ?></td>
            <td><?php echo $cita['tratamiento']; ?></td>
            <td><?php echo $cita['fecha']; ?></td>
            <td><?php echo $cita['hora']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>


    <script>
        // Convertir las horas a objetos Date para cálculos
        function toDateTime(date, time) {
            let [year, month, day] = date.split('-');
            let [hours, minutes, seconds] = time.split(':');
            return new Date(year, month - 1, day, hours, minutes, seconds);
        }

        // Función para mostrar las alertas
        function showAlert(message, type) {
            Swal.fire({
                title: message,
                icon: type,
                showCancelButton: false,
                confirmButtonText: 'OK'
            });
        }

        // Función para calcular las horas
        function calculateTimes() {
            const citas = <?php echo json_encode($citas); ?>;
            const tratamientos = <?php echo json_encode($tratamientos); ?>;
            
            citas.forEach(cita => {
                let citaTime = toDateTime(cita.fecha, cita.hora);
                let tratamientoDuration = tratamientos[cita.tratamiento] || 0; // Duración en minutos
                let tratamientoEndTime = new Date(citaTime.getTime() + tratamientoDuration * 60000); // Sumar duración

                let alertBefore = new Date(citaTime.getTime() - 5 * 60000);
                let alertAfter = new Date(tratamientoEndTime.getTime() + 5 * 60000);

                let now = new Date();

                if (now >= alertBefore && now < citaTime) {
                    showAlert('Su cita se aproxima', 'info');
                } else if (now >= alertAfter && now < (alertAfter.getTime() + 60000)) {
                    Swal.fire({
                        title: 'Seleccione una opción',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Completado',
                        denyButtonText: 'Propuesto',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Actualizar a completado
                            updateStatus(cita.id, 'COMPLETADO');
                        } else if (result.isDenied) {
                            // Propuesto, pedir nueva hora y fecha
                            let newDate = prompt('Ingrese la nueva fecha (YYYY-MM-DD):');
                            let newTime = prompt('Ingrese la nueva hora (HH:MM:SS):');
                            if (newDate && newTime) {
                                updateStatus(cita.id, 'PENDIENTE', newDate, newTime);
                            } else {
                                showAlert('Fecha y hora no válidas', 'error');
                            }
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Cancelado
                            updateStatus(cita.id, 'CANCELADO');
                        }
                    });
                }
            });
        }

        // Función para actualizar el estado en la base de datos
        function updateStatus(id, status, date = null, time = null) {
            let formData = new FormData();
            formData.append('id', id);
            formData.append('status', status);
            if (date) formData.append('date', date);
            if (time) formData.append('time', time);

            fetch('update_status.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                showAlert('Estado actualizado correctamente', 'success');
            })
            .catch(error => {
                showAlert('Error al actualizar el estado', 'error');
            });
        }

        // Ejecutar el cálculo de tiempos al cargar la página y cada minuto
        calculateTimes();
        setInterval(calculateTimes, 60000);
    </script>
</body>
</html>
