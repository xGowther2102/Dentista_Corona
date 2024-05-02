<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dentista_corona";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la encuesta
$sql = "SELECT comodidad_limpieza, tiempo_espera, atencion_doctor FROM encuesta_satisfaccion";
$result = $conn->query($sql);

// Array para almacenar las respuestas
$respuestas = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $respuestas[] = $row;
  }
}

// Procesamiento de datos para las gráficas
$nivelesComodidad = array(0, 0, 0, 0, 0); // Insatisfecho, Poco satisfecho, Neutral, Satisfecho, Muy satisfecho
$nivelesTiempo = array(0, 0, 0, 0, 0); // Insatisfecho, Poco satisfecho, Neutral, Satisfecho, Muy satisfecho
$nivelesAtencion = array(0, 0, 0, 0, 0); // Insatisfecho, Poco satisfecho, Neutral, Satisfecho, Muy satisfecho

if (!empty($respuestas)) {
  foreach ($respuestas as $respuesta) {
    // Comodidad y limpieza
    switch ($respuesta['comodidad_limpieza']) {
      case 1:
        $nivelesComodidad[0]++;
        break;
      case 2:
        $nivelesComodidad[1]++;
        break;
      case 3:
        $nivelesComodidad[2]++;
        break;
      case 4:
        $nivelesComodidad[3]++;
        break;
      case 5:
        $nivelesComodidad[4]++;
        break;
      default:
        break;
    }

    // Tiempo de espera
    switch ($respuesta['tiempo_espera']) {
      case 1:
        $nivelesTiempo[0]++;
        break;
      case 2:
        $nivelesTiempo[1]++;
        break;
      case 3:
        $nivelesTiempo[2]++;
        break;
      case 4:
        $nivelesTiempo[3]++;
        break;
      case 5:
        $nivelesTiempo[4]++;
        break;
      default:
        break;
    }

    // Atención del doctor
    switch ($respuesta['atencion_doctor']) {
      case 1:
        $nivelesAtencion[0]++;
        break;
      case 2:
        $nivelesAtencion[1]++;
        break;
      case 3:
        $nivelesAtencion[2]++;
        break;
      case 4:
        $nivelesAtencion[3]++;
        break;
      case 5:
        $nivelesAtencion[4]++;
        break;
      default:
        break;
    }
  }
}

$conn->close();
?>