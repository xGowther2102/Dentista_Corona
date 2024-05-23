<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pacientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/tabla_citas.css">
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php require '../../assets/MENU/index.php'; ?>
</head>

<main class="dark-mod">
    <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">Pacientes Registrados</h1>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead id="tabla_1">
                    <tr>
                        <th>Paciente</th>
                        <th>Nombre Completo</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Antecedentes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="resultados_tabla">
                    <?php
                    require "../../assets/tabla_paciente/datos_tabla.php";
                    $numFila = 1;
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $numFila . "</td>";
                        echo "<td>" . $fila['nombre'] . " " . $fila['apellido_paterno'] . " " . $fila['apellido_materno'] . "</td>";
                        echo "<td>" . $fila['telefono'] . "</td>";
                        echo "<td>" . $fila['email'] . "</td>";
                        echo "<td>" . $fila['edad'] . "</td>";
                        echo "<td>" . $fila['sexo'] . "</td>";
                        echo "<td>" . $fila['historial_medico'] . "</td>";
                        echo "<td>";
                        echo "<div class='btn-group' role='group'>";
                        echo "<button class='btn btn-success btn-sm rounded-circle m-1 citas-btn' data-bs-toggle='modal' data-bs-target='#citasModal' data-id='" . $fila['id'] . "'>+</button>";
                        echo "<button class='btn btn-danger btn-sm rounded-circle m-1 eliminar-btn' data-id='" . $fila['id'] . "'>-</button>";
                        echo "<button class='btn btn-primary btn-sm rounded-circle m-1 actualizar-btn' data-bs-toggle='modal' data-bs-target='#actualizarModal' data-id='" . $fila['id'] . "'>✎</button>";
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
        <div>
            <button id="exportar-btn" class="btn btn-success" style="margin-bottom: 10px;">Exportar a Excel</button>
        </div>
        <br>
        <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
    </div>
    <!-- Modal de Actualización -->
    <div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- modal-lg para aumentar el tamaño del modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actualizarModalLabel">Actualizar Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="actualizarForm">
                        <input type="hidden" id="idPacienteActualizar" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombreAct">Nombre:</label>
                                    <input type="text" class="form-control" id="nombreAct" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoPaternoAct">Apellido paterno:</label>
                                    <input type="text" class="form-control" id="apellidoPaternoAct" name="apellido_paterno" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoMaternoAct">Apellido materno:</label>
                                    <input type="text" class="form-control" id="apellidoMaternoAct" name="apellido_materno" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefonoAct">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefonoAct" name="telefono" required>
                                </div>
                                <div class="form-group">
                                    <label for="correoAct">Correo electrónico:</label>
                                    <input type="email" class="form-control" id="correoAct" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fechaNacimientoAct">Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" id="fechaNacimientoAct" name="fecha_nacimiento" required>
                                </div>
                                <div class="form-group">
                                    <label for="direccionAct">Dirección:</label>
                                    <input type="text" class="form-control" id="direccionAct" name="direccion" required>
                                </div>
                                <div class="form-group">
                                    <label for="sexoAct">Sexo:</label>
                                    <input type="text" class="form-control" id="sexoAct" name="sexo" required>
                                </div>
                                <div class="form-group">
                                    <label for="historialAct">Antecedentes:</label>
                                    <textarea class="form-control" id="historialAct" name="historial_medico"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de CITAS -->
    <div class="modal fade" id="citasModal" tabindex="-1" aria-labelledby="citasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- modal-lg para aumentar el tamaño del modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="citasModalLabel">Agregar Nueva Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="citasForm">
                        <input type="hidden" id="idPacienteCita" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombreAct">Nombre:</label>
                                    <input type="text" class="form-control" id="nombreCit" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoPaternoAct">Apellido paterno:</label>
                                    <input type="text" class="form-control" id="apellidoPaternoCit" name="apellido_paterno" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoMaternoAct">Apellido materno:</label>
                                    <input type="text" class="form-control" id="apellidoMaternoCit" name="apellido_materno" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="correo">Correo electrónico:</label>
                                    <input type="email" class="form-control" id="correoCit" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha de consulta:</label>
                                    <input type="date" class="form-control" id="fechaCit" name="fecha" required>
                                </div>
                                <div class="form-group">
                                    <label for="direccionAct">Hora:</label>
                                    <select id="horaCit" name="hora" required></select>
                                </div>
                                <div class="form-group">
                                    <label for="sexoAct">Tratamiento:</label>
                                    <input type="text" class="form-control" id="tratamientoCit" name="tratamiento" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-------MODAL DE ACTUALIZAR-------->
    <script>
        $(document).ready(function() {
            $('.actualizar-btn').click(function() {
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: '../../assets/tabla_paciente/obtener_datos.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#idPacienteActualizar').val(response.id);
                        $('#nombreAct').val(response.nombre);
                        $('#apellidoPaternoAct').val(response.apellido_paterno);
                        $('#apellidoMaternoAct').val(response.apellido_materno);
                        $('#telefonoAct').val(response.telefono);
                        $('#correoAct').val(response.email);
                        $('#fechaNacimientoAct').val(response.fecha_nacimiento);
                        $('#direccionAct').val(response.direccion);
                        $('#historialAct').val(response.historial_medico);
                        $('#sexoAct').val(response.sexo);
                        $('#actualizarModal').modal('show');
                    }
                });
            });

            // Cuando se envíe el formulario de actualización
            $('#actualizarForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '../../assets/tabla_paciente/actualizar_datos.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Actualizado correctamente'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#actualizarModal').modal('hide');
                                location.reload();
                            }
                        });
                    }
                });
            });
        });
    </script>
    <!-------MODAL DE CITAS-------->
    <script>
        $(document).ready(function() {
            $('.citas-btn').click(function() {
                var id = $(this).data('id');
                console.log(id);
                const res = $.ajax({
                    url: '../../assets/tabla_paciente/obtener_for_cita.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#idPacienteCita').val(response.id);
                        $('#nombreCit').val(response.nombre);
                        $('#apellidoPaternoCit').val(response.apellido_paterno);
                        $('#apellidoMaternoCit').val(response.apellido_materno);
                        $('#telefonoCit').val(response.telefono);
                        $('#correoCit').val(response.email);
                        $('#fechaCit').val(response.fecha_nacimiento);
                        $('#direccionCit').val(response.direccion);
                        $('#historialCit').val(response.historial_medico);
                        $('#sexoCit').val(response.sexo);
                        $('#citasModal').modal('show');
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#fechaCit').on('change', function() {
                var fecha = $(this).val();
                $.ajax({
                    url: '../../assets/tabla_paciente/getAvailableHours.php',
                    type: 'GET',
                    data: {
                        fecha: fecha
                    },
                    dataType: 'json',
                    success: function(data) {
                        var horaSelect = $('#horaCit');
                        horaSelect.empty();
                        $.each(data, function(index, hora) {
                            var option = $('<option>').text(hora).val(hora);
                            horaSelect.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener las horas disponibles:', error);
                    }
                });
            });

            $('#citasForm').submit(function(event) {
                event.preventDefault(); // Evita el envío del formulario por defecto
                var formData = $(this).serialize(); // Serializa los datos del formulario

                $.ajax({
                    url: '../../assets/tabla_paciente/scheduleAppointment.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Muestra la respuesta del servidor en la consola
                        // Muestra un mensaje con SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Cita registrada'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#actualizarModal').modal('hide');
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al enviar el formulario:', error);
                    }
                });
            });
        });
    </script>
</main>
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
<script src="../../js/eliminar.js"></script>

</html>