<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <style>
        .table .estatus-completado {
            background-color: #d4edda; /* Verde */
        }

        .table .estatus-cancelado {
            background-color: #f8d7da; /* Rojo */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Citas Completadas y Canceladas</h1>
        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#citasModal">
            Ver Citas
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="citasModal" tabindex="-1" aria-labelledby="citasModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="citasModalLabel">Citas Completadas y Canceladas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                        FROM citas c INNER JOIN pacientes p ON c.pacientes_id = p.id
                                        WHERE c.estatus IN ('COMPLETADO', 'CANCELADO');";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $claseEstado = '';
                                        switch ($row['estatus']) {
                                            case 'COMPLETADO':
                                                $claseEstado = 'estatus-completado';
                                                break;
                                            case 'CANCELADO':
                                                $claseEstado = 'estatus-cancelado';
                                                break;
                                        }
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['nombre']}</td>";
                                        echo "<td>{$row['apellido_paterno']}</td>";
                                        echo "<td>{$row['apellido_materno']}</td>";
                                        echo "<td>{$row['antecedentes']}</td>";
                                        echo "<td class='$claseEstado'>{$row['estatus']}</td>";
                                        echo "<td>{$row['tratamiento']}</td>";
                                        echo "<td>{$row['fecha']}</td>";
                                        echo "<td>{$row['hora']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No hay citas completadas o canceladas</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
