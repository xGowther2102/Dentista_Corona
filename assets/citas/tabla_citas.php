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
    <?php require '../../assets/MENU/index.php'; ?>
</head>

<main class="dark-mod">
    <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">Lista de Citas</h1>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead id="tabla_1">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Tratamiento</th>
                        <th>Fecha</th>
                        <th>Acciones</th> <!-- Nueva columna para acciones -->
                    </tr>
                </thead>
                <tbody id="resultados_tabla">
                    <!-- Filas de la tabla con botones de Eliminar y Actualizar -->
                    <tr>
                        <td>Maria Pérez</td>
                        <td>Doctora</td>
                        <td>2022-05-15</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Juan García</td>
                        <td>Enfermero</td>
                        <td>2022-06-20</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Luisa Martínez</td>
                        <td>Terapeuta</td>
                        <td>2022-07-10</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Pablo Sánchez</td>
                        <td>Psicólogo</td>
                        <td>2022-08-05</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Ana López</td>
                        <td>Recepcionista</td>
                        <td>2022-09-15</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Carlos Hernández</td>
                        <td>Farmacéutico</td>
                        <td>2022-10-25</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>María José García</td>
                        <td>Asistente Médico</td>
                        <td>2022-11-30</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>José Pérez</td>
                        <td>Paramédico</td>
                        <td>2023-01-10</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Isabel Fernández</td>
                        <td>Odontóloga</td>
                        <td>2023-02-15</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Jorge Martín</td>
                        <td>Terapeuta Ocupacional</td>
                        <td>2023-03-20</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sofía Gómez</td>
                        <td>Enfermera Jefe</td>
                        <td>2023-04-25</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>David Pérez</td>
                        <td>Psiquiatra</td>
                        <td>2023-05-30</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Ana Martínez</td>
                        <td>Neuróloga</td>
                        <td>2023-06-25</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Pablo Pérez</td>
                        <td>Fisioterapeuta</td>
                        <td>2023-07-30</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>María Fernández</td>
                        <td>Enfermera</td>
                        <td>2023-08-25</td>
                        <td>
                            <!-- Botón Eliminar -->
                            <button class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>
                            <!-- Botón Actualizar -->
                            <button class="btn btn-primary btn-sm actualizar-btn">Actualizar</button>
                        </td>
                    </tr>

                    <!-- Repite estas filas para cada dato -->
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

</html>