<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tratamientos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Gestión de Tratamientos</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarTratamientoModal">
            Agregar Tratamiento
        </button>

        <!-- Modal para agregar tratamiento -->
        <div class="modal fade" id="agregarTratamientoModal" tabindex="-1" aria-labelledby="agregarTratamientoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="agregarTratamientoForm" method="post">
                            <div class="form-group">
                                <label for="nombreTratamiento">Nombre del Tratamiento:</label>
                                <input type="text" class="form-control" id="nombreTratamiento" name="nombreTratamiento" required>
                            </div>
                            <div class="form-group">
                                <label for="duracionTratamiento">Duración (en minutos):</label>
                                <input type="number" class="form-control" id="duracionTratamiento" name="duracionTratamiento" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla para mostrar tratamientos -->
        <div id="tablaTratamientos">
            <?php
            require 'conexion.php';

            $result = $conn->query("SELECT * FROM tratamientos");

            echo "<table class='table mt-3'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Duración (min)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['duracion']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm editar-btn' data-id='{$row['id']}'>Editar</button>
                            <button class='btn btn-danger btn-sm borrar-btn' data-id='{$row['id']}'>Borrar</button>
                        </td>
                      </tr>";
            }

            echo "</tbody>
                </table>";

            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Función para cargar la tabla de tratamientos
            function cargarTablaTratamientos() {
                $('#tablaTratamientos').load('tabla_tratamientos.php');
            }

            // Cargar la tabla al cargar la página
            cargarTablaTratamientos();

            // Agregar tratamiento
            $('#agregarTratamientoForm').on('submit', function (e) {
                e.preventDefault();
                $.post('agregar_tratamiento.php', $(this).serialize(), function (data) {
                    alert(data);
                    $('#agregarTratamientoModal').modal('hide');
                    cargarTablaTratamientos();
                });
            });

            // Delegación de eventos para botones de editar y borrar
            $('#tablaTratamientos').on('click', '.editar-btn', function () {
                var id = $(this).data('id');
                $('#editarTratamientoModal').remove(); // Eliminar cualquier modal existente antes de cargar uno nuevo
                $('body').append('<div id="editarTratamientoModal"></div>'); // Crear contenedor para el modal
                $('#editarTratamientoModal').load('editar_tratamiento_modal.php?id=' + id, function () {
                    $('#editarTratamientoModal').modal('show');
                });
            });

            $('#tablaTratamientos').on('click', '.borrar-btn', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esto",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, bórralo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('borrar_tratamiento.php', {id: id}, function (data) {
                            alert(data);
                            cargarTablaTratamientos();
                            Swal.fire(
                                '¡Borrado!',
                                'El tratamiento ha sido borrado.',
                                'success'
                            );
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
