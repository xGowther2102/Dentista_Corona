<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: ../../iniciar_sesion.php");
    exit();
}

$correo = $_SESSION['correo'];
require "../../assets/tabla_paciente/datos_tabla.php";

// Obtener el ID del usuario a partir del correo
$query = "SELECT id FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$usuario_id = $usuario['id'];

// Consulta SQL para obtener las citas
$sql = "SELECT p.id AS paciente_id, p.nombre AS nombre_paciente, p.apellido_paterno, p.apellido_materno, c.tratamiento, c.id AS cita_id
        FROM pacientes p
        INNER JOIN citas c ON p.id = c.pacientes_id
        WHERE c.usuario_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/tabla_citas.css">
    <?php require '../../assets/MENU/index.php'; ?>
</head>

<body>
<main class="dark-mod">
    <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">Lista de Citas</h1>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead id="tabla_1">
                    <tr>
                        <th>Paciente</th>
                        <th>Nombre Completo</th>
                        <th>Tratamiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="resultados_tabla">
                <?php
                $numFila = 1;
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $numFila . "</td>";
                    echo "<td>" . htmlspecialchars($fila['nombre_paciente']) . " " . htmlspecialchars($fila['apellido_paterno']) . " " . htmlspecialchars($fila['apellido_materno']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['tratamiento']) . "</td>";
                    echo "<td>";
                    echo "<div class='btn-group' role='group'>";
                    echo "<button class='btn btn-info btn-sm rounded-circle m-1 historial-btn' data-id='" . htmlspecialchars($fila['paciente_id']) . "'>📋</button>";
                    echo "<button class='btn btn-danger btn-sm rounded-circle m-1 eliminar-btn' data-id='" . htmlspecialchars($fila['cita_id']) . "'>-</button>";
                    echo "<button class='btn btn-primary btn-sm rounded-circle m-1 actualizar-btn' data-bs-toggle='modal' data-bs-target='#actualizarModal' data-id='" . htmlspecialchars($fila['cita_id']) . "'>✎</button>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                    $numFila++;
                }
                ?>
                </tbody>
            </table>
        </div>
        <br>
        <div style="display: flex; justify-content: space-between;">
            <div style="margin-right: 10px;">
                <a href="../../assets/pacientes/nuevo_paciente.php">
                    <button id="historial-btn" class="btn btn-outline-warning" style="margin-bottom: 10px;">Agregar Paciente</button>
                </a>
            </div>
            <div style="margin-right: 10px;">
                <a href="#">
                    <button id="historial-btn" class="btn btn-outline-info" style="margin-bottom: 10px;">Historial de Citas</button>
                </a>
            </div>
            <div style="margin-left: auto;">
                <button id="exportar-btn" class="btn btn-success" style="margin-bottom: 10px;">Exportar a Excel</button>
            </div>
        </div>
        <br>
        <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
    </div>
</main>

<!-- Modal para historial de citas -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historialModalLabel">Historial de Citas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="historialTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Doctor</th>
                            <th>Tratamiento</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody id="historialResultados">
                        <!-- Los resultados se cargarán aquí dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap y DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script src="../../js/tabla_citas.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        // Manejar la apertura del modal y cargar datos
        $('.historial-btn').on('click', function() {
            var pacienteId = $(this).data('id');
            $.ajax({
                url: '../../assets/citas/historial_citas.php',
                method: 'POST',
                data: { paciente_id: pacienteId },
                success: function(response) {
                    $('#historialResultados').html(response);
                    $('#historialModal').modal('show');
                }
            });
        });
    });


    $(document).ready(function() {
        $('#dataTable').DataTable();

        // Manejar la apertura del modal y cargar datos
        $('.historial-btn').on('click', function() {
            var pacienteId = $(this).data('id');
            $.ajax({
                url: 'historial.citas.php',
                method: 'POST',
                data: { paciente_id: pacienteId },
                success: function(response) {
                    $('#historialResultados').html(response);
                    $('#historialModal').modal('show');
                }
            });
        });
    });
</script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
