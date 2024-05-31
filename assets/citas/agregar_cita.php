<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nueva cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/cita_paciente.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    .modal-header {
        color: #010e28;
    }

    .modal-body {
        color: #010e28;
    }

    .dark-mode .modal-header {
        color: #ffffff;
        background-color: #222;
        border: #230;
    }

    .dark-mode .modal-footer {
        color: #ffffff;
        background-color: #222;
        border: #230;
    }

    .dark-mode .modal-body {
        color: #ffffff;
        background-color: #222;
        border: #230;
    }
</style>

<body>
    <?php require_once '../../assets/MENU/index.php'; ?>
    <main class="dark-mod">
        <div class="container">
            <h1 class="text-center mb-4">AGENDAR NUEVA CITA</h1>
            <div class="img-container" style="display: flex; justify-content: center; align-items: center;">
                <img src="../../images/registro.png" alt="Icono" style="max-width: 65px; margin-right: 1px;">
            </div>
            <br>
            <div class="formulario-container">
                <form id="registroForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                            </div>

                            <div class="form-group">
                                <label for="apellidoP">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="apellidoP" placeholder="Ingrese su apellido paterno">
                            </div>

                            <div class="form-group">
                                <label for="date">Fecha y Hora:</label>
                                <input type="datetime-local" class="form-control" id="date" placeholder="Ingrese la fecha y hora">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellidoM">Apellido Materno:</label>
                                <input type="text" class="form-control" id="apellidoM" placeholder="Ingrese su apellido materno">
                            </div>
                            <div class="form-group">
                                <label for="duracion">Duracion de la cita:</label>
                                <input type="text" class="form-control" id="duracion" placeholder="Ingrese duracion">
                            </div>
                            <div class="form-group">
                                <label for="tratamiento">Tratamiento:</label>
                                <textarea class="form-control" id="tratamiento" placeholder="Ingrese el tratamiento"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="btn-container">
                        <br>
                        <button type="button" class="btn btn-primary btn-shine" onclick="registrarCita()">Agendar
                            Cita</button>
                        <button type="button" class="btn btn-secondary btn-shine" data-bs-toggle="modal" data-bs-target="#errorModal">Cancelar</button>
                    </div>
                </form>
            </div>
            <br>
            <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        </div>

        <!-- Modal de error -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">¡Error!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Por favor, complete todos los campos antes de agendar la cita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/cita_paciente.js"></script>
</body>

</html>