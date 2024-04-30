<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar a Excel</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.2.1/exceljs.min.js"></script>
</head>

<body>
    <table id="tabla" class="display">
        <!-- Aquí van tus datos de la tabla -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John</td>
                <td>Doe</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane</td>
                <td>Smith</td>
            </tr>
        </tbody>
    </table>

    <button id="exportar-btn">Exportar a Excel</button>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();

            $('#exportar-btn').click(function() {
                var table = $('#tabla').DataTable();
                var data = table.rows().data().toArray();

                var excel = new ExcelJS.Workbook();
                var sheet = excel.addWorksheet('Datos');
                sheet.addRows(data);

                excel.xlsx.writeBuffer().then(function(buffer) {
                    saveAs(new Blob([buffer]), 'datos.xlsx');
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.2.1/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>

</body>

</html>