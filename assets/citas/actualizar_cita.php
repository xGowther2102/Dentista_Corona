<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nuevo paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/cita_paciente.css">

</head>

<?php require_once '../../assets/MENU/index.php'; ?>
<main class="dark-mod">
    <div class="container">
        <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        <h1 class="text-center mb-4">ACTUALIZAR CITA</h1>
        <div class="img-container" style="display: flex; justify-content: center; align-items: center;">
            <img src="../../images/registro.png" alt="Icono" style="max-width: 65px; margin-right: 1px;">
        </div>
        <br>
        <div class="formulario-container">
            <div class="col-left">
                <form action="#">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre">
                    </div>

                    <div class="form-group">
                        <label for="apellidoP">Apellido Materno:</label>
                        <input type="text" class="form-control" id="apellidoP" placeholder="Ingrese el apellido materno">
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="correo" placeholder="">
                    </div>
                </form>
            </div>

            <div class="col-right">
                <form action="#">
                    <div class="form-group">
                        <label for="correo">Apellido Paterno:</label>
                        <input type="email" class="form-control" id="correo" placeholder="Ingrese el apellido paterno">
                    </div>

                    <div class="form-group">
                        <label for="Tratamiento">Tratamiento</label>
                        <textarea class="form-control" id="Tratamiento" placeholder="Ingrese el tratamiento"></textarea>
                    </div>
                </form>
            </div>
            <div class="btn-container">
                <br>
                <button type="button" class="btn btn-primary btn-shine" onclick="registrarPaciente()">Actualizar</button>
                <button type="button" class="btn btn-secondary btn-shine" data-bs-toggle="modal" data-bs-target="#errorModal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Éxito!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Se ha registrado con éxito el paciente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
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
                    Por favor, complete todos los campos antes de registrar al paciente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../../js/cita_paciente.js"></script>
</main>


</html>