<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Responsiva con Filtro y Paginación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Buscar por nombre completo">
            </div>
            <div class="col-md-2">
                <label for="perPageSelect">Mostrar:</label>
                <select id="perPageSelect" class="form-control">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="all">Todos</option>
                </select>
            </div>
        </div>
        <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Padecimiento</th>
                    <th>Eliminar</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody id="dataBody">
                <!-- Aquí se insertarán los datos dinámicamente -->
            </tbody>
        </table>
        <div id="pagination"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>
