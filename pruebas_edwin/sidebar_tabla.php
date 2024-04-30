<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pacientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <?php require_once '../assets/MENU/index.php' ; ?>
</head>

<main>
    <div class="container">
        <h1 class="my-4">Lista de Pacientes</h1>
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Tratamiento</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Maria Pérez</td>
                    <td>Doctora</td>
                    <td>2022-05-15</td>
                </tr>
                <tr>
                    <td>Juan García</td>
                    <td>Paciente</td>
                    <td>2022-06-20</td>
                </tr>
                <tr>
                    <td>Carlos López</td>
                    <td>Enfermero</td>
                    <td>2022-07-10</td>
                </tr>
                <tr>
                    <td>Ana Martínez</td>
                    <td>Doctora</td>
                    <td>2022-08-05</td>
                </tr>
                <tr>
                    <td>Pablo Rodríguez</td>
                    <td>Doctor</td>
                    <td>2022-09-12</td>
                </tr>
                <tr>
                    <td>Luisa Fernández</td>
                    <td>Enfermera</td>
                    <td>2022-10-18</td>
                </tr>
                <tr>
                    <td>Ricardo Gómez</td>
                    <td>Paciente</td>
                    <td>2022-11-25</td>
                </tr>
                <tr>
                    <td>María García</td>
                    <td>Doctora</td>
                    <td>2022-12-30</td>
                </tr>
                <tr>
                    <td>Andrés Pérez</td>
                    <td>Doctor</td>
                    <td>2023-01-05</td>
                </tr>
                <tr>
                    <td>Laura Martínez</td>
                    <td>Enfermera</td>
                    <td>2023-02-10</td>
                </tr>
                <tr>
                    <td>José González</td>
                    <td>Paciente</td>
                    <td>2023-03-15</td>
                </tr>
                <tr>
                    <td>Marta Sánchez</td>
                    <td>Doctora</td>
                    <td>2023-04-20</td>
                </tr>
                <tr>
                    <td>Jorge Fernández</td>
                    <td>Doctor</td>
                    <td>2023-05-25</td>
                </tr>
                <tr>
                    <td>Roberto Pérez</td>
                    <td>Enfermero</td>
                    <td>2023-06-30</td>
                </tr>
                <tr>
                    <td>Elena Martínez</td>
                    <td>Doctora</td>
                    <td>2023-07-05</td>
                </tr>
                <tr>
                    <td>Luis González</td>
                    <td>Doctor</td>
                    <td>2023-08-10</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                "paging": true,
                "pageLength": 5, // Mostrar solo 5 datos por página
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todos"]
                ],
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas por página",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "zeroRecords": "No se encontraron resultados",
                    "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
</main>