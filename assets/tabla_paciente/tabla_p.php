<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}
$sql = "SELECT id, nombre, apellido_paterno, apellido_materno, telefono, email, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad, historial_medico, sexo
FROM pacientes WHERE id = id";
$resultado = mysqli_query($conn, $sql);
?>

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
    <link rel="stylesheet" href="../../css/tabla.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    $numFila = 1;
                        while($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>".$numFila."</td>";
                            echo "<td>".$fila['nombre']." ".$fila['apellido_paterno']." ".$fila['apellido_materno']."</td>";
                            echo "<td>".$fila['telefono']."</td>";
                            echo "<td>".$fila['email']."</td>";
                            echo "<td>".$fila['edad']."</td>";
                            echo "<td>".$fila['sexo']."</td>";
                            echo "<td>".$fila['historial_medico']."</td>";
                            echo "<td>";
                            echo "<div class='btn-group' role='group'>";
                            echo "<button class='btn btn-success btn-sm rounded-circle m-1 citas-btn' data-bs-toggle='modal' data-bs-target='#citasModal' data-id='".$fila['id']."'>+</button>";
                            echo "<button class='btn btn-danger btn-sm rounded-circle m-1 eliminar-btn' data-id='".$fila['id']."'>-</button>";
                            echo "<button class='btn btn-primary btn-sm rounded-circle m-1 actualizar-btn' data-bs-toggle='modal' data-bs-target='#actualizarModal' data-id='".$fila['id']."'>✎</button>";
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
<script src="../../js/tabla.js"></script>
<script src="../../js/eliminar.js"></script>
</html>
