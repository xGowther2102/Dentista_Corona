<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
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
                    <th>Acciones</th> <!-- Nueva columna para acciones -->
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
        // Llama a la API para obtener los datos de la cita
        fetch(`obtener_cita.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                // Muestra los datos en el modal
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
                        // Llama a la API para actualizar los datos de la cita
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
</body>
</html>
