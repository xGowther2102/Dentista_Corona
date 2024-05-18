<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $correo = $row['correo'];
        
        $_SESSION['username'] = $username;
        $_SESSION['correo'] = $correo;
        
        echo 'success';
    } else {
        echo 'Usuario o contraseña incorrectos.';
    }
}
?>
