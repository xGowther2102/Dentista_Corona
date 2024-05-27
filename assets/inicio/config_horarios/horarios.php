<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dentista_Corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$alert_message = "";
$alert_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'create') {
        $dia_semana = $_POST['dia_semana'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $descanso_inicio = $_POST['descanso_inicio'];
        $descanso_fin = $_POST['descanso_fin'];

        $sql = "INSERT INTO horarios (dia_semana, hora_inicio, hora_fin, descanso_inicio, descanso_fin)
                VALUES ('$dia_semana', '$hora_inicio', '$hora_fin', '$descanso_inicio', '$descanso_fin')";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "Nuevo horario creado exitosamente";
            $alert_type = "success";
        } else {
            $alert_message = "Error: " . $sql . "<br>" . $conn->error;
            $alert_type = "error";
        }
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $dia_semana = $_POST['dia_semana'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $descanso_inicio = $_POST['descanso_inicio'];
        $descanso_fin = $_POST['descanso_fin'];

        $sql = "UPDATE horarios SET dia_semana='$dia_semana', hora_inicio='$hora_inicio', hora_fin='$hora_fin', descanso_inicio='$descanso_inicio', descanso_fin='$descanso_fin'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "Horario actualizado exitosamente";
            $alert_type = "success";
        } else {
            $alert_message = "Error: " . $sql . "<br>" . $conn->error;
            $alert_type = "error";
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'];

        $sql = "DELETE FROM horarios WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "Horario eliminado exitosamente";
            $alert_type = "success";
        } else {
            $alert_message = "Error: " . $sql . "<br>" . $conn->error;
            $alert_type = "error";
        }
    }
}

$sql = "SELECT * FROM horarios";
$result = $conn->query($sql);

$horarios = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $horarios[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestor de Horarios - Consultorio Dental</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <h2 class="mt-5">Gestor de Horarios - Consultorio Dental</h2>
    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addModal">Añadir Horario</button>
    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addTreatmentModal">Añadir Tratamiento</button>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Día de la Semana</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Descanso Inicio</th>
                <th>Descanso Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horarios as $horario): ?>
                <tr>
                    <td><?php echo $horario['dia_semana']; ?></td>
                    <td><?php echo $horario['hora_inicio']; ?></td>
                    <td><?php echo $horario['hora_fin']; ?></td>
                    <td><?php echo $horario['descanso_inicio']; ?></td>
                    <td><?php echo $horario['descanso_fin']; ?></td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#updateModal<?php echo $horario['id']; ?>">Actualizar</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $horario['id']; ?>">Eliminar</button>
                    </td>
                </tr>
                
                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $horario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Actualizar Horario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="horarios.php">
                                <div class="modal-body">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?php echo $horario['id']; ?>">
                                    <div class="form-group">
                                        <label>Día de la Semana</label>
                                        <input type="text" class="form-control" name="dia_semana" value="<?php echo $horario['dia_semana']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Hora Inicio</label>
                                        <input type="time" class="form-control" name="hora_inicio" value="<?php echo $horario['hora_inicio']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Hora Fin</label>
                                        <input type="time" class="form-control" name="hora_fin" value="<?php echo $horario['hora_fin']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Descanso Inicio</label>
                                        <input type="time" class="form-control" name="descanso_inicio" value="<?php echo $horario['descanso_inicio']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Descanso Fin</label>
                                        <input type="time" class="form-control" name="descanso_fin" value="<?php echo $horario['descanso_fin']; ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?php echo $horario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Horario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="horarios.php">
                                <div class="modal-body">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $horario['id']; ?>">
                                    <p>¿Estás seguro de que quieres eliminar este horario?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="horarios.php">
                <div class="modal-body">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label>Día de la Semana</label>
                        <input type="text" class="form-control" name="dia_semana" required>
                    </div>
                    <div class="form-group">
                        <label>Hora Inicio</label>
                        <input type="time" class="form-control" name="hora_inicio" required>
                    </div>
                    <div class="form-group">
                        <label>Hora Fin</label>
                        <input type="time" class="form-control" name="hora_fin" required>
                    </div>
                    <div class="form-group">
                        <label>Descanso Inicio</label>
                        <input type="time" class="form-control" name="descanso_inicio">
                    </div>
                    <div class="form-group">
                        <label>Descanso Fin</label>
                        <input type="time" class="form-control" name="descanso_fin">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Treatment Modal -->
<div class="modal fade" id="addTreatmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Tratamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="nuevo_tratamiento.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre del Tratamiento</label>
                        <input type="text" class="form-control" name="nombre_tratamiento" required>
                    </div>
                    <div class="form-group">
                        <label>Duración (en minutos)</label>
                        <input type="number" class="form-control" name="duracion" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if ($alert_message): ?>
        Swal.fire({
            title: "<?php echo $alert_type === 'success' ? 'Éxito' : 'Error'; ?>",
            text: "<?php echo $alert_message; ?>",
            icon: "<?php echo $alert_type; ?>"
        });
    <?php endif; ?>
});
</script>

</body>
</html>

