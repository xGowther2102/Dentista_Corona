<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert con sonido recurrente</title>
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


    <script>
        const paciente = <?php echo json_encode($pacientes); ?>;
        console.log(pacientes.nombre);
        function showAlert() {
            Swal.fire({
                title: 'Aviso',
                text: `La cita de ${paciente.nombre} ${paciente.apellido_paterno} se aproxima.`,
                icon: 'info',
                timer: 5000,  // 5 segundos en milisegundos
                timerProgressBar: true
            });

            // Reproducir sonido
            const audio = new Audio('beep-07.mp3');
            audio.play();

            // Verificar permisos de notificación y mostrar notificación si es posible
            if (Notification.permission === 'granted') {
                showBrowserNotification();
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        showBrowserNotification();
                    }
                });
            }
        }

        // function showBrowserNotification() {
        //     const notification = new Notification('¡Notificación!', {
        //         body: 'Esto es una alerta con sonido.',
        //         icon: 'ruta/a/tu/icono.png'
        //     });

        //     // Reproducir sonido al recibir la notificación
        //     notification.onshow = () => {
        //         const audio = new Audio('beep-07.mp3');
        //         audio.play();
        //     };
        // }

        // Ejecutar la función showAlert cada 5 segundos
        setInterval(showAlert, 5000);
    </script>
</body>
</html> -->
