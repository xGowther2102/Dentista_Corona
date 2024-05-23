<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    // Si no está autenticado, redirigirlo al inicio de sesión
    header("Location: ../../iniciar_sesion.php");
    exit();
}

$host = "localhost"; // Cambiar si es necesario
$usuario_db = "root"; // Cambiar al nombre de usuario de la base de datos
$password_db = ""; // Cambiar a la contraseña de la base de datos
$nombre_db = "Dentista_Corona"; // Cambiar al nombre de la base de datos

// Crear la conexión
$mysqli = new mysqli($host, $usuario_db, $password_db, $nombre_db);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Obtener el ID del usuario basado en su correo electrónico
$correo = $_SESSION['correo'];
$query = "SELECT id FROM usuarios WHERE correo = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$usuario_id = $usuario['id'];

// Recibir los datos del formulario para cada día
$hora_inicio_lunes = $_POST['hora_inicio_lunes'];
$hora_fin_lunes = $_POST['hora_fin_lunes'];
$hora_inicio_Martes = $_POST['hora_inicio_Martes'];
$hora_fin_Martes = $_POST['hora_fin_Martes'];
$hora_inicio_Miercoles = $_POST['hora_inicio_Miercoles'];
$hora_fin_Miercoles = $_POST['hora_fin_Miercoles'];
$hora_inicio_Jueves = $_POST['hora_inicio_Jueves'];
$hora_fin_Jueves = $_POST['hora_fin_Jueves'];
$hora_inicio_Viernes = $_POST['hora_inicio_Viernes'];
$hora_fin_Viernes = $_POST['hora_fin_Viernes'];
$hora_inicio_Sabado = $_POST['hora_inicio_Sabado'];
$hora_fin_Sabado = $_POST['hora_fin_Sabado'];
$hora_inicio_Domingo = $_POST['hora_inicio_Domingo'];
$hora_fin_Domingo = $_POST['hora_fin_Domingo'];

// Preparar y ejecutar las consultas para insertar los horarios en la base de datos
$query = "INSERT INTO horarios (usuario_id, dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

// Lunes
$dia_semana = 'Lunes';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_lunes, $hora_fin_lunes);
$stmt->execute();

// Martes
$dia_semana = 'Martes';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_Martes, $hora_fin_Martes);
$stmt->execute();

// Miercoles
$dia_semana = 'Miercoles';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_Miercoles, $hora_fin_Miercoles);
$stmt->execute();

// Jueves
$dia_semana = 'Jueves';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_Jueves, $hora_fin_Jueves);
$stmt->execute();

// Viernes
$dia_semana = 'Viernes';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_Viernes, $hora_fin_Viernes);
$stmt->execute();

// Sabado
$dia_semana = 'Sabado';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_Sabado, $hora_fin_Sabado);
$stmt->execute();

// Domingo
$dia_semana = 'Domingo';
$stmt->bind_param("isss", $usuario_id, $dia_semana, $hora_inicio_Domingo, $hora_fin_Domingo);
$stmt->execute();

// Verificar si se insertaron los datos correctamente
if ($stmt->affected_rows > 0) {
    echo "Horarios guardados correctamente";
} else {
    echo "Error al guardar los horarios";
}

$stmt->close();
$mysqli->close();
?>
