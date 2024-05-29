<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el ID del usuario activo
if (isset($_POST['usuario_id'])) {
    $usuario_id = $_POST['usuario_id'];

    // Realizar la consulta SQL para obtener las citas del usuario activo
    $query = "SELECT `id`, `pacientes_id`, `fecha`, `hora`, `estatus`, `tratamiento`, `usuario_id`, duracion FROM `citas` WHERE `usuario_id` = $usuario_id";

    // Ejecutar la consulta y obtener los resultados
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Construir el array de citas
        $citas = array();
        while ($row = $result->fetch_assoc()) {
            $citas[] = $row;
        }
        
        // Devolver los resultados como un JSON
        echo json_encode(array('success' => true, 'citas' => $citas));
    } else {
        echo json_encode(array('success' => false, 'error' => 'No se encontraron citas para este usuario.'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'No se ha proporcionado el ID del usuario activo.'));
}
?>
