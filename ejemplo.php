<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultorio Dental</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Añade este enlace a SweetAlert CDN en la sección head de tu HTML -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body>
    <h1>Agendar Cita</h1>
    <form id="appointment-form">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        
        <label for="hora">Hora:</label>
        <select id="hora" name="hora" required></select>
        
        <button type="submit">Agendar</button>
    </form>

    <script>
        $(document).ready(function() {
    $('#fecha').on('change', function() {
        var fecha = $(this).val();
        $.ajax({
            url: './getAvailableHours.php',
            type: 'GET',
            data: { fecha: fecha },
            dataType: 'json',
            success: function(data) {
                var horaSelect = $('#hora');
                horaSelect.empty();
                $.each(data, function(index, hora) {
                    var option = $('<option>').text(hora).val(hora);
                    horaSelect.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener las horas disponibles:', error);
            }
        });
    });

    $('#appointment-form').submit(function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto
        var formData = $(this).serialize(); // Serializa los datos del formulario

        $.ajax({
            url: './scheduleAppointment.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                console.log(data); // Muestra la respuesta del servidor en la consola
                // Muestra un mensaje con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: data.message
                });
                // Restablecer los valores del formulario
                $('#nombre').val('');
                $('#email').val('');
                $('#fecha').val('');
                $('#hora').empty(); // Limpiar opciones de hora si es necesario
            },
            error: function(xhr, status, error) {
                console.error('Error al enviar el formulario:', error);
            }
        });
    });
});

    </script>
</body>
</html>
