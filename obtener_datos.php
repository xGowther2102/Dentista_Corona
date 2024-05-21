<?php
$servername = "localhost"; // Cambia esto por el nombre de tu servidor, generalmente es "localhost"
$username = "root";  // Cambia esto por tu nombre de usuario
$password = ""; // Cambia esto por tu contraseña
$dbname = "Dentista_Corona"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tratamientos</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir SweetAlert2 -->
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
            <!-- Contenido del modal -->
        </div>

        <!-- Tabla para mostrar tratamientos -->
        <div id="tablaTratamientos">
            <?php include 'tabla_tratamientos.php'; ?>
        </div>
    </div>

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Función para cargar el contenido del modal de agregar tratamiento
            $('#agregarTratamientoModal').on('show.bs.modal', function (e) {
                $(this).load('agregar_tratamiento_modal.php');
            });

            // Delegación de eventos para botones de editar y borrar
            $('#tablaTratamientos').on('click', '.editar-btn', function () {
                var id = $(this).data('id');
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
                            $('#tablaTratamientos').load('tabla_tratamientos.php'); // Recargar la tabla
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
