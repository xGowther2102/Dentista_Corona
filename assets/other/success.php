<!DOCTYPE html>
<html>

<head>
    <title>Éxito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <strong>¡Correo enviado!</strong> Se ha enviado un correo con instrucciones para restablecer tu contraseña a la dirección: <em><?php echo htmlspecialchars($_GET['correo']); ?></em>. Por favor, verifica tu bandeja de entrada y también la carpeta de spam o correo no deseado si no ves el correo en tu bandeja de entrada.
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar modal después de cargar la página
        $(document).ready(function() {
            $('#successModal').modal('show');
        });
    </script>
</body>

</html>