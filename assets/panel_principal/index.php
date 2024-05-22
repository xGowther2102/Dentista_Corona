<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}
$sql = "SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.estatus, c.tratamiento, c.fecha, c.hora
FROM citas c INNER JOIN pacientes p ON c.pacientes_id = p.id;";
$resultado = mysqli_query($conn, $sql);
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

    <?php require '../../assets/MENU/index.php'; ?>
</head>

<body>
    <main class="dark-mod">
        <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">CITAS SIGUIENTES</h1>
        <br>
        <div class="container">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead id="tabla_1">
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Tratamiento</th>
                            <th>Antecedentes</th>
                            <th>Estatus</th>
                            <th>Fecha y hora</th>
                            <th>Acciones</th> 
                        </tr>
                    </thead>
                    <tbody id="resultados_tabla">
                    <?php
                        while($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>".$fila['nombre']." ".$fila['apellido_paterno']." ".$fila['apellido_materno']."</td>";
                            echo "<td>".$fila['tratamiento']."</td>";
                            echo "<td>".$fila['antecedentes']."</td>";
                            echo "<td>".$fila['estatus']."</td>";
                            echo "<td>".$fila['fecha']." ".$fila['hora']."</td>";
                            echo "<td>";
                            echo "<button class='btn btn-danger btn-sm eliminar-btn' data-id='".$fila['id']."'>Eliminar</button>";
                            echo "<button class='btn btn-primary btn-sm actualizar-btn' data-bs-toggle='modal' data-bs-target='#actualizarModal' data-id='".$fila['id']."'>Actualizar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
            <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        </div>
        <button class="btn btn-primary btn-sm " id="citas-pasadas-btn">CITAS PASADAS</button>
    </main>

    <!-- Modal de Citas Pasadas -->
    <div class="modal fade" id="citasPasadasModal" tabindex="-1" aria-labelledby="citasPasadasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="citasPasadasModalLabel">Citas Pasadas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Tratamiento</th>
                                <th>Antecedentes</th>
                                <th>Estatus</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody id="citas-pasadas-tabla">
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
