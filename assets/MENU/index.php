<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['correo'])) {
    // Si el usuario no ha iniciado sesión, puedes redirigirlo a la página de inicio de sesión
    header("Location: ../../iniciar_sesion.php");
    exit();
}

// Obtener los datos del usuario de la sesión
$usuario = $_SESSION['username'];
$correo = $_SESSION['correo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="../../assets/MENU/style.css">

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
</head>

<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img src="../../images/home.ico" alt="CORONA" width="55px" height="55px">
                <span>CORONA &copy;</span>
            </div>
        </div>

        <nav class="navegacion">
            <ul>
                <li>
                    <a href="../../pages/inicio/index.php">
                        <ion-icon name="home-outline"></ion-icon>
                        <span>Panel Principal</span>
                    </a>
                </li>
                <li>
                    <a href="../../pages/citas/lista_citas.php">
                        <ion-icon name="albums-outline"></ion-icon>
                        <span>Citas</span>
                    </a>
                </li>
                <li hidden>
                    <a href="../../pages/citas/agregar_cita.php">
                        <ion-icon name="add-outline"></ion-icon>
                        <span>Nueva cita</span>
                    </a>
                </li>
                <li>
                    <a href="../../pages/pacientes/lista_pacientes.php">
                        <ion-icon name="people-outline"></ion-icon>
                        <span>Pacientes</span>
                    </a>
                </li>
                <li hidden>
                    <a href="../../pages/pacientes/nuevo_paciente.php">
                        <ion-icon name="person-add-outline"></ion-icon>
                        <span>N. Paciente</span>
                    </a>
                </li>
                <li>
                    <a href="../../pages/graficas/results.php">
                        <ion-icon name="stats-chart-outline"></ion-icon>
                        <span>Graficas</span>
                    </a>
                </li>
                <li>
                    <a href="../../pages/configuraciones/configuraciones.php">
                        <ion-icon name="time-outline"></ion-icon>
                        <span>Configuracion <br> de horarios</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="information-circle-outline"></ion-icon>
                        <span style="font-size: 1em;">Informacion de la
                            <br>app web</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div>
            <div class="linea"></div>

            <div class="modo-oscuro">
                <div class="info">
                    <ion-icon name="moon-outline"></ion-icon>
                    <span style="font-size: 1em;">Modo Oscuro</span>
                </div>
                <div class="modo-oscuro-toggle">
                    <div class="switch" id="modo-oscuro-switch">
                        <div class="base">
                            <div class="circulo"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="usuario">
                <img src="../../assets/MENU/Jhampier.jpg" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre"><?php echo $usuario; ?></span>
                        <span class="email"><?php echo $correo; ?></span>
                    </div>
                    <div class="opciones-usuario">
                        <ion-icon name="ellipsis-vertical-outline" onclick="mostrarOpciones()"></ion-icon>
                        <div id="opciones" class="opciones">
                            <button onclick="editarContrasena()">Editar Contraseña</button>
                            <button onclick="editarImagen()">Editar Imagen</button>
                            <button onclick="confirmarCerrarSesion()">Cerrar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarOpciones() {
            var opciones = document.querySelector('.opciones');
            opciones.style.display = opciones.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            var opciones = document.querySelector('.opciones');
            var icono = document.querySelector('.opciones-usuario ion-icon');
            if (event.target != opciones && event.target != icono) {
                opciones.style.display = 'none';
            }
        };

        function confirmarCerrarSesion() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas cerrar sesión?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    cerrarSesion();
                }
            });
        }

        function cerrarSesion() {
            window.location.href = "../../assets/MENU/logout.php";
        }

        function editarContrasena() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../../assets/MENU/logout.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    window.location.href = "../../cambiar_pswd.php";
                }
            };
            xhr.send();
        }

        function editarImagen() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas cambiar la imagen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cambiar imagen',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige a la página de edición de imagen (puedes cambiar la URL según sea necesario)
                    window.location.href = "../../assets/MENU/edit_image.php";
                }
            });
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../../assets/MENU/script.js"></script>
</body>

</html>