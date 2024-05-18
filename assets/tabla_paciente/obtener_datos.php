<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id_paciente = $_GET['id'];
    $sql = "SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.fecha_hora, c.estatus, c.tratamiento
    FROM citas c INNER JOIN pacientes p ON c.paciente_id = $id_paciente";
    $resultado = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        $alumno = mysqli_fetch_assoc($resultado);
        echo json_encode($alumno);
    } else {
        echo json_encode(array("error" => "No se encontraron datos para el ID proporcionado."));
    }
} else {

    echo json_encode(array("error" => "No se proporcionó el ID del alumno."));
}

mysqli_close($conn);
?>
