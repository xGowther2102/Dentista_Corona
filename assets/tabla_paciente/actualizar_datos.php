<?php
// Verificar si se recibieron los datos del formulario
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Recibir los datos del formulario y escaparlos para evitar inyección de SQL
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $historial_medico = $_POST['historial_medico'];
    $sexo = $_POST['sexo'];

    // Conectar a la base de datos (reemplaza los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Dentista_Corona";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL de actualización
    $sql = "UPDATE pacientes SET nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno', telefono='$telefono', email='$email', fecha_nacimiento='$fecha_nacimiento', direccion='$direccion', historial_medico='$historial_medico', sexo='$sexo' WHERE id=$id";

    // Ejecutar la consulta y verificar si se realizó con éxito
    if ($conn->query($sql) === TRUE) {
        echo "Los datos del paciente se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos del paciente: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si no se recibieron los datos del formulario, devolver un mensaje de error
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
