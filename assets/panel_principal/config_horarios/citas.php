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

// Obtener tratamientos
$sql = "SELECT * FROM tratamientos";
$result = $conn->query($sql);
$tratamientos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tratamientos[] = $row;
    }
}

// Obtener horarios y citas para mostrar disponibilidad
$sql = "SELECT * FROM horarios";
$result = $conn->query($sql);
$horarios = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $horarios[] = $row;
    }
}

// Obtener citas existentes
$sql = "SELECT * FROM citas";
$result = $conn->query($sql);
$citas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestor de Citas - Consultorio Dental</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <h2 class="mt-5">Gestor de Citas - Consultorio Dental</h2>
    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addCitaModal">Añadir Cita</button>

    <!-- Add Modal for Cita -->
    <div class="modal fade" id="addCitaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="crear_cita.php">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="create">
                        <div class="form-group">
                            <label>Fecha de la Cita</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label>Hora de la Cita</label>
                            <input type="time" class="form-control" name="hora" required>
                        </div>
                        <div class="form-group">
                            <label>Tratamiento</label>
                            <select class="form-control" name="tratamiento_id">
                                <option value="">Seleccione un tratamiento</option>
                                <?php foreach ($tratamientos as $tratamiento): ?>
                                    <option value="<?php echo $tratamiento['id']; ?>"><?php echo $tratamiento['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#addTratamientoModal">Añadir nuevo tratamiento</button>
                        </div>
                        <div class="form-group">
                            <label>Duración (minutos)</label>
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
