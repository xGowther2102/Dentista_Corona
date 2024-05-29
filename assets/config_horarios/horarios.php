<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios de Trabajo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>

    <style>
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: rgb(155, 155, 155);
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        input[type="button"] {
            width: 100%;
        }

        .dark-mode main {
            color: #fff;
            background-color: #222;
        }

        .dark-mode .main-container {
            color: #fff;
            background-color: #222;
        }

        .dark-mode .form-container {
            background-color: #222;
            color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .dark-mode h1 {
            color: rgb(222, 222, 222);
            border-bottom: 1px solid #fff;
        }

        .dark-mode td {
            border-bottom: 2px solid #ddd;
            background-color: #222;
        }

        .dark-mode .table>:not(caption)>*>* {
            color: #fff;
            background-color: #222;
            border-color: #696969;
        }

        .dark-mode .table>thead {
            border-color: #696969;
        }

        .dark-mode .form-control:disabled {
            background-color: #222;
            color: #fff;
            opacity: 1;
            border-color: #696969;
        }

        input[type="button"] {
            width: 100%;
        }
        .card {
    background-color: #222;
    color: #fff;
    border-radius: 20px;
    padding: 30px;
    max-width: 600px;
    text-align: center;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
    animation: slideIn 1s ease-out;
    margin: auto; /* Agregar esta línea para centrar */
}


p {
    font-size: 18px;
    margin-bottom: 20px;
}
    </style>
</head>


<main class="dark-mod">
<div class="card">
        <h1>Bienvenido al Sistema Corona Doctor <?php echo $usuario ?></h1>
        <p>Gracias por unirse a nosotros. Para poder llevar a cabo un buen uso del sistema, debe empezar a llenar estos formularios para realizar una mayor administración de sus citas. Nuestra administración le permite especificar las horas y días en los que laborará</p>
    </div>
    <div class="main-container">
        <div class="form-container">
            <h1 class="my-4">Horario de Chamba</h1>

            <form id="formularioHorarios">
                <input type="hidden" name="correo" id="correo" value="<?php echo $correo; ?>">
                <div>
                    <?php include '../../assets/fecha/fecha_en_vivo.php'; ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Día de la Semana</th>
                            <th>Hora de Inicio</th>
                            <th>Hora Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="LUNES" id="LUNES" value="LUNES" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_lunes" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_lunes" step="1800" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="MARTES" id="Martes" value="MARTES" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_Martes" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_Martes" step="1800" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="MIERCOLES" id="Miercoles" value="MIERCOLES" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_Miercoles" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_Miercoles" step="1800" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="JUEVES" id="Jueves" value="JUEVES" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_Jueves" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_Jueves" step="1800" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="VIERNES" id="Viernes" value="VIERNES" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_Viernes" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_Viernes" step="1800" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="SABADO" id="Sabado" value="SABADO" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_Sabado" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_Sabado" step="1800" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="DOMINGO" id="Domingo" value="DOMINGO" disabled class="form-control"></td>
                            <td><input type="time" name="hora_inicio_Domingo" step="1800" class="form-control" required></td>
                            <td><input type="time" name="hora_fin_Domingo" step="1800" class="form-control" required></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <input type="button" value="Guardar Horarios" class="btn btn-outline-primary" onclick="guardarHorarios()">
            </form>
        </div>

    </div>
</main>
<script>
  function guardarHorarios() {
    // Validar que al menos uno de los campos de tiempo tenga un valor antes de enviar los datos
    var camposVacios = false;

    // Iterar sobre los campos de tiempo de cada día de la semana
    $("input[type='time']").each(function() {
        if (!$(this).val()) {
            camposVacios = true;
            return false; // Detener la iteración si se encuentra un campo vacío
        }
    });

    // Si hay campos vacíos, mostrar mensaje de error y detener el proceso de envío
    if (camposVacios) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debes completar al menos un campo de hora de inicio o hora final.'
        });
        return; // Detener el proceso de envío si hay campos vacíos
    }

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
                text: 'Se agregó correctamente su horario'
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

</html>