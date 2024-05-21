// get_schedules.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dentista_Corona";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM horarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['dia']}</td>
                <td>{$row['hora_inicio']}</td>
                <td>{$row['hora_fin']}</td>
                <td>{$row['descanso_inicio']}</td>
                <td>{$row['descanso_fin']}</td>
                <td>
                    <button class='editSchedule' data-id='{$row['id']}'>Editar</button>
                    <button class='deleteSchedule' data-id='{$row['id']}'>Eliminar</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay horarios configurados</td></tr>";
}

$conn->close();
?>
