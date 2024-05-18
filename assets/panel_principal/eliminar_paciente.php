<?php
// Verificar si se recibió el ID del paciente a eliminar
if(isset($_POST['id'])){
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Dentista_Corona";
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    // Verificar la conexión
    if(!$conn){
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    // Obtener el ID del paciente a eliminar
    $id = $_POST['id'];
    
    // Consulta SQL para eliminar al paciente
    $sql = "DELETE FROM citas WHERE paciente_id  = $id";
    
    // Ejecutar la consulta
    if(mysqli_query($conn, $sql)){
        echo "Paciente eliminado exitosamente";
    } else {
        echo "Error al eliminar el paciente: " . mysqli_error($conn);
    }
    
    // Cerrar la conexión
    mysqli_close($conn);
} else {
    // Si no se recibió el ID del paciente, mostrar un mensaje de error
    echo "Error: No se recibió el ID del paciente a eliminar";
}
?>
