<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el ID del usuario activo
if (isset($_POST['usuario_id'])) {
    $usuario_id = $_POST['usuario_id'];

    // Realizar la consulta SQL para obtener los tratamientos del usuario activo
    $query = "SELECT `id`, `duracion`, `pacientes_id`, `usuario_id` FROM `tratamientos` WHERE `usuario_id` = $usuario_id";

    // Ejecutar la consulta y obtener los resultados
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Construir el array de tratamientos
        $tratamientos = array();
        while ($row = $result->fetch_assoc()) {
            $tratamientos[] = $row;
        }
        
        // Devolver los resultados como un JSON
        echo json_encode(array('success' => true, 'tratamientos' => $tratamientos));
    } else {
        echo json_encode(array('success' => false, 'error' => 'No se encontraron tratamientos para este usuario.'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'No se ha proporcionado el ID del usuario activo.'));
}
?>
