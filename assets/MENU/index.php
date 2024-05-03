<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="../../assets/MENU/style.css">
</head>

<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <ion-icon name="home-outline"></ion-icon>
                <span>CORONA &copy;</span>
            </div>
        </div>

        <nav class="navegacion">
            <ul>
                <li>
                    <a href="#">
                        <ion-icon name="home-outline"></ion-icon>
                        <span>Panel Principal</span>
                    </a>
                </li>
                <li>
                    <a href="../../assets/citas/tabla_citas.php">
                        <ion-icon name="albums-outline"></ion-icon>
                        <span>Citas</span>
                    </a>
                </li>
                <li>
                    <a href="../../assets/citas/agregar_cita.php">
                        <ion-icon name="add-outline"></ion-icon>
                        <span>Nueva cita</span>
                    </a>
                </li>
                <li>
                    <a href="../../assets/tabla_paciente/tabla_p.php">
                        <ion-icon name="people-outline"></ion-icon>
                        <span>Pacientes</span>
                    </a>
                </li>
                <li>
                    <a href="../../assets/pacientes/nuevo_paciente.php">
                        <ion-icon name="person-add-outline"></ion-icon>
                        <span>N. Paciente</span>
                    </a>
                </li>
                <li>
                    <a href="../../assets/graficas/graficas.php">
                        <ion-icon name="stats-chart-outline"></ion-icon>
                        <span>Graficas</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="reader-outline"></ion-icon>
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
                        <span class="nombre">HOLA</span>
                        <span class="email">HOLA@gmail.com</span>
                    </div>
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                </div>
            </div>
        </div>

    </div>
    <!--
<main class="dark-mod">
<?php
/*
    require_once 'grafica.php';
    */
?>
</main>
-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../../assets/MENU/script.js"></script>
</body>

</html>