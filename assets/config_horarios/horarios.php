<?php
session_start();
if(!isset($_SESSION['correo'])){ 
    header("Location: ../../iniciar_sesion.php");
    exit();
}
$correo = $_SESSION['correo'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<main class="dark-mod">
    <h1 class="my-4" style="text-align: center; color: rgb(155, 155, 155); border: 1px black;">Lista de Citas</h1>
    <form id="formularioHorarios">
    <input type="hidden" name="correo" id="correo" value="<?php echo $correo; ?>">
        <table>
            <tr>
                <th>Día de la Semana</th>
                <th>Hora de Inicio</th>
                <th>Hora Final</th>
            </tr>
            <tr>
                <td><input type="text" name="LUNES" id="LUNES" value="LUNES" disabled></td>
                <td><input type="time" name="hora_inicio_lunes" step="1800" required></td>
                <td><input type="time" name="hora_fin_lunes" step="1800" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Martes" id="Martes" value="Martes" disabled></td>
                <td><input type="time" name="hora_inicio_Martes" step="1800" required></td>
                <td><input type="time" name="hora_fin_Martes" step="1800" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Miercoles" id="Miercoles" value="Miercoles" disabled></td>
                <td><input type="time" name="hora_inicio_Miercoles" step="1800" required></td>
                <td><input type="time" name="hora_fin_Miercoles" step="1800" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Jueves" id="Jueves" value="Jueves" disabled></td>
                <td><input type="time" name="hora_inicio_Jueves" step="1800" required></td>
                <td><input type="time" name="hora_fin_Jueves" step="1800" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Viernes" id="Viernes" value="Viernes" disabled></td>
                <td><input type="time" name="hora_inicio_Viernes" step="1800" required></td>
                <td><input type="time" name="hora_fin_Viernes" step="1800" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Sábado" id="Sabado" value="Sábado" disabled></td>
                <td><input type="time" name="hora_inicio_Sabado" step="1800" required></td>
                <td><input type="time" name="hora_fin_Sabado" step="1800" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Domingo" id="Domingo" value="Domingo" disabled></td>
                <td><input type="time" name="hora_inicio_Domingo" step="1800" required></td>
                <td><input type="time" name="hora_fin_Domingo" step="1800" required></td>
            </tr>
        </table>
        <br>
        <input type="button" value="Guardar Horarios" onclick="guardarHorarios()">
    </form>
    <script>
        function guardarHorarios() {
            // Recolectar los datos del formulario
            var formData = $("#formularioHorarios").serialize();

            // Enviar los datos al servidor mediante AJAX
            $.ajax({
                type: "POST",
                url: "../../assets/config_horarios/configuracion.php",
                data: formData,
                success: function(response) {
                    Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Se agrego correctamente su horario'
                        });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                            icon: 'error',
                            title: '¡ERROR!',
                            text: 'ERROR AL AGREGAR'
                        });
                }
            });
        }
    </script>
</main>
</html>