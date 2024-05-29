<?php
include 'conexion.php';
session_start();
if (isset($_SESSION['username'])) {
    $usuario = $_SESSION['username'];
} else {
    header("../sesion.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Sistema Corona Doctor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="card">
        <h1>Bienvenido al Sistema Corona Doctor <?php echo $usuario ?></h1>
        <p>Gracias por unirse a nosotros. Para poder llevar a cabo un buen uso del sistema, debe empezar a llenar estos formularios para realizar una mayor administración de sus citas. Nuestra administración le permite especificar las horas y días en los que laborará, así como activar las notificaciones si lo desea.</p>
        <button class="btn">Horarios</button>
        <button class="btn">Notificaciones</button>
    </div>
</body>
</html>
