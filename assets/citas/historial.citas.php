<?php
require "../../assets/tabla_paciente/datos_tabla.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paciente_id = $_POST['paciente_id'];

    $query = "SELECT c.fecha, c.hora, u.nombre AS doctor, c.tratamiento, c.estatus
              FROM citas c
              INNER JOIN usuarios u ON c.usuario_id = u.id
              WHERE c.pacientes_id = ?
              ORDER BY c.fecha, c.hora";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $paciente_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $estatus = htmlspecialchars($row['estatus']);
        $estatusClass = $estatus == 'Completado' ? 'text-success' : ($estatus == 'Cancelado' ? 'text-danger' : '');

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hora']) . "</td>";
        echo "<td>" . htmlspecialchars($row['doctor']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tratamiento']) . "</td>";
        echo "<td class='" . $estatusClass . "'>" . $estatus . "</td>";
        echo "</tr>";
    }

    $stmt->close();
}

$conn->close();
?>
