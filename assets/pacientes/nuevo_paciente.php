<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nuevo paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/cita_paciente.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<?php require_once '../../assets/MENU/index.php'; ?>
<main class="dark-mod">
    <div class="hora">
        <div class="container">
            <h1 class="text-center mb-4">AGREGAR NUEVO PACIENTE</h1>
            <div class="img-container" style="display: flex; justify-content: center; align-items: center;">
                <img src="../../images/registro.png" alt="Icono" style="max-width: 65px; margin-right: 1px;">
            </div>
            <br>
            <div class="formulario-container">
                <form id="regiPaciente">
                    <div class="col-left">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="apellidoP">Apellido paterno:</label>
                            <input type="text" class="form-control" id="apellidoP" placeholder="Ingrese su apellido paterno" required>
                        </div>

                        <div class="form-group">
                            <label for="apellidoM">Apellido materno:</label>
                            <input type="text" class="form-control" id="apellidoM" placeholder="Ingrese su apellido materno" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono" placeholder="Ingrese su número de teléfono" required>
                        </div>
                    </div>
                    <div class="col-right">
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo electrónico" required>
                        </div>

                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fechaNacimiento" required>
                        </div>

                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input class="form-control" id="direccion" placeholder="Ingrese su dirección" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control animate-select" id="sexo" required>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="historial">Antecedentes:</label>
                        <textarea class="form-control" id="historial" placeholder="Ingrese los antecedentes médicos del paciente"></textarea required>
                    </div>
                    <div class="btn-container">
                        <br>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
            <br>
            <?php require_once '../../assets/fecha/fecha_en_vivo.php'; ?>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../js/pacientes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../../js/cita_paciente.js"></script>

</html>
