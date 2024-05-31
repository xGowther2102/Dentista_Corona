<?php
// Verificar si se recibieron los datos del formulario
if(isset($_POST['nombre']) && isset($_POST['apellidoP']) && isset($_POST['apellidoM']) && isset($_POST['telefono']) && isset($_POST['correo']) && isset($_POST['fechaNacimiento']) && isset($_POST['direccion']) && isset($_POST['sexo']) && isset($_POST['historial'])) {
    
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];
    $historial = $_POST['historial'];
    
    
    // Conexión a la base de datos (cambia los valores según tu configuración)
    $conexion = new mysqli("localhost", "root", "", "Dentista_Corona");
    
    // Verificar la conexión
    if($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    // Preparar la consulta SQL para insertar los datos del paciente
    $sql = "INSERT INTO `pacientes`(nombre, apellido_paterno, apellido_materno, telefono, email, fecha_nacimiento, direccion, historial_medico, sexo)
    VALUES ('$nombre', '$apellidoP', '$apellidoM', '$telefono', '$correo', '$fechaNacimiento', '$direccion', '$sexo', '$historial')";
    
    // Ejecutar la consulta y verificar si fue exitosa
    if($conexion->query($sql) === TRUE) {
        echo "Registro exitoso"; // Esto se enviará como respuesta a la solicitud AJAX
    } else {
        echo "Error al registrar el paciente: " . $conexion->error; // Esto se enviará como respuesta en caso de error
    }
    
    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    echo "Todos los campos son requeridos"; // Enviar un mensaje si no se recibieron todos los campos del formulario
}
?>
