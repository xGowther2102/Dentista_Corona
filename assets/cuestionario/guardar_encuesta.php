<?php
session_start();
// Conectarse a la base de datos (cambia los datos según tu configuración)
$conexion = new mysqli("localhost", "root", "", "dentista_corona");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$comodidad = $_POST['comfort'];
$tiempoEspera = $_POST['waitTime'];
$atencionDoctor = $_POST['doctorCare'];

// Preparar la consulta SQL para insertar los datos en la tabla
$consulta = "INSERT INTO encuesta_satisfaccion (comodidad_limpieza, tiempo_espera, atencion_doctor) VALUES ($comodidad, $tiempoEspera, $atencionDoctor)";

// Ejecutar la consulta
if ($conexion->query($consulta) === TRUE) {
    // Guardar el tiempo en que se respondió la encuesta
    $_SESSION['encuesta_respondida'] = time();

    // Redirigir a una página de éxito después de guardar los datos
    echo '<script>window.open("agradecimientos.php", "_blank");</script>';
    echo '<script>window.history.replaceState(null, null, window.location.href);</script>'; // Eliminar la URL de la página actual del historial
    exit(); // Importante: asegúrate de salir del script después de la redirección
} else {
    echo "Error al guardar la encuesta: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
