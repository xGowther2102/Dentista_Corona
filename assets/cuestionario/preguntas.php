<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de Satisfacción</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
session_start();

// Verificar si el usuario ya ha respondido la encuesta en el tiempo especificado (por ejemplo, 1 día)
if (isset($_SESSION['encuesta_respondida']) && time() - $_SESSION['encuesta_respondida'] < 86400) {
    // Si el tiempo aún no ha pasado, redirigir a la página de acceso denegado
    header('Location: acceso_denegado.php');
    exit();
}
?>

<body>

    <div class="container">
        <h1 class="mt-5 mb-4">Encuesta de Satisfacción</h1>
        <form id="surveyForm" action="guardar_encuesta.php" method="POST">
            <div class="mb-3">
                <label for="comfort">¿Está satisfecho con la comodidad y limpieza de nuestras instalaciones?</label>
                <select class="form-select" id="comfort" name="comfort" required>
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="1">Insatisfecho</option>
                    <option value="2">Poco satisfecho</option>
                    <option value="3">Neutral</option>
                    <option value="4">Satisfecho</option>
                    <option value="5">Muy satisfecho</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="waitTime">¿Está satisfecho con su Tiempo de espera?</label>
                <select class="form-select" id="waitTime" name="waitTime" required>
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="1">Insatisfecho</option>
                    <option value="2">Poco satisfecho</option>
                    <option value="3">Neutral</option>
                    <option value="4">Satisfecho</option>
                    <option value="5">Muy satisfecho</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="doctorCare">¿Está satisfecho con la atención prestada por el doctor que le atendió?</label>
                <select class="form-select" id="doctorCare" name="doctorCare" required>
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="1">Insatisfecho</option>
                    <option value="2">Poco satisfecho</option>
                    <option value="3">Neutral</option>
                    <option value="4">Satisfecho</option>
                    <option value="5">Muy satisfecho</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>