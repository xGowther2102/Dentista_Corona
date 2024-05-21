<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="icon" type="image/x-icon" href="../../images/icon.ico">
    <!-- Incluir Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        window.onload = function() {
            // Obtener la fecha actual
            var currentDate = new Date();
            var day = String(currentDate.getDate()).padStart(2, '0');
            var month = String(currentDate.getMonth() + 1).padStart(2, '0');
            var year = currentDate.getFullYear();
            var today = year + '-' + month + '-' + day;

            // Establecer la fecha actual en el input de fecha
            document.getElementById('fecha').value = today;

            // Establecer el día actual en el input de día
            var days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            var currentDay = days[currentDate.getDay()];
            document.getElementById('diaActual').value = currentDay;

            // Generar las opciones de hora en formato 12 horas con AM y PM
            var selectHoraInicio = document.getElementById('horaInicio');
            var selectHoraFin = document.getElementById('horaFin');
            var times = generateTimeOptions(7, 20);

            times.forEach(time => {
                var optionInicio = new Option(time, time);
                var optionFin = new Option(time, time);
                selectHoraInicio.add(optionInicio);
                selectHoraFin.add(optionFin);
            });

            document.getElementById('fecha').addEventListener('change', function() {
                var selectedDate = new Date(this.value);
                var currentDate = new Date();
                if (selectedDate < currentDate) {
                    document.getElementById('fecha').value = today;
                    Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'No puedes seleccionar una fecha pasada.'
                        });
                }
            });
        };

        function generateTimeOptions(startHour, endHour) {
            var times = [];
            for (var i = startHour; i <= endHour; i++) {
                var hour = i % 12 === 0 ? 12 : i % 12;
                var ampm = i < 12 ? 'AM' : 'PM';
                times.push(hour + ':00 ' + ampm);
            }
            return times;
        }
    </script>
</head>

<?php require '../../assets/graficas/graficas.php' ; ?>

</html>