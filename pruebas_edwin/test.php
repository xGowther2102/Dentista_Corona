<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para el contenido principal */
        .main-content {
            margin-top: 52px;
            margin-left: 0;
            transition: margin-left 0.5s;
            padding: 20px;
        }

        /* Estilo para el sidebar */
        .sidebar {
            height: 100%;
            width: 200px;
            /* Reducir el ancho del sidebar a 200px */
            position: fixed;
            top: 0;
            left: -200px;
            /* Ajustar la posición inicial a -200px */
            background-color: #1C3059;
            color: #f2f2f2;
            padding-top: 20px;
            transition: left 0.5s;
            z-index: 1;
        }

        /* Estilo para la imagen en la sidebar */
        .sidebar img {
            max-width: 100%;
            /* Ajusta el tamaño máximo de la imagen */
            height: auto;
            /* Permite que la imagen mantenga su proporción */
            margin-top: 20px;
            /* Margen superior */
            margin-bottom: 20px;
            /* Margen inferior */
        }

        /* Estilo para el texto de créditos en la sidebar */
        .sidebar .credits {
            margin-top: 200px;
            /* Margen superior */
            color: #f2f2f2;
            /* Color del texto de créditos */
            font-size: 14px;
            /* Tamaño de fuente */
        }

        /* Estilo para el contenido del sidebar */
        .sidebar .container-fluid {
            padding-top: 20px;
            /* Ajusta el espacio superior */
        }


        /* Estilo para los enlaces del sidebar */
        .sidebar a {
            padding: 10px;
            text-decoration: none;
            color: white;
            display: block;
        }

        #toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
            background-color: transparent;
            /* Cambio de color a transparente */
            border: none;
            cursor: pointer;
            transition: left 0.5s, color 0.3s;
            /* Agrega transición al color */
            color:#333333;
            /* Cambio de color de las líneas a negro o gris */
        }

        /* Estilo para las líneas horizontales en el botón de toggle */
        #toggle-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            /* Cambio de color de las líneas a negro */
            margin-bottom: 5px;
            transition: background-color 0.3s;
            /* Agrega transición al color de las líneas */
        }

        /* Efecto al pasar el cursor sobre el botón completo */
        #toggle-btn:hover {
            background-color: rgba(0, 0, 0, 0.5);
            /* Cambio de color al pasar el cursor */
        }

        /* Efecto al pasar el cursor sobre el botón */
        #toggle-btn:hover span {
            background-color:blue;
            /* Cambio de color al pasar el cursor */

        }


        /* Estilo para el botón de regresar sidebar */
        #return-sidebar {
            position: fixed;
            top: 50%;
            left: 220px;
            transform: translateY(-50%);
            z-index: 999;
            background-color: #2b3f68;
            /* Cambia el color de fondo a blanco */
            border: 2px solid black;
            /* Agrega un borde */
            color: whitesmoke;
            /* Cambia el color del texto a negro */
            transition: opacity 0.4s ease;
            /* Agrega una transición suave */
            opacity: 0;
            /* Inicialmente oculto */
        }

        /* Estilo para el texto del botón de regreso */
        #return-sidebar:hover {
            background-color: #f2f2f2;
            /* Cambia el color de fondo al pasar el cursor */
            color: #333333;
            /* Cambia el color del texto al pasar el cursor */
        }

        .content-strip {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            /* Altura de la franja */
            background-color: #1C3040;
            /* Color de fondo blanco */
            border-bottom: 1px solid black;
            /* Línea negra en la parte inferior */
            z-index: -1;
            /* Coloca la franja detrás del contenido */
        }



        /* Animación para el botón de regresar sidebar */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Botón para mostrar/ocultar el sidebar -->
    <button id="toggle-btn" class="btn btn-primary">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="container-fluid">
            <!-- Agregar imagen centrada -->
            <div class="text-center">
                <img src="../images/Logo_Big.png" alt="Imagen de la sidebar" class="img-fluid">
            </div>
            <a href="#">Inicio</a>
            <a href="#">Servicios</a>
            <a href="#">Acerca de</a>
            <a href="#">Contacto</a>
        </div>
        <!-- Texto de créditos -->
        <div class="credits text-center">
            <p>2024 &copy; Sistema Dental "Corona"</p>
        </div>
    </div>


    <!-- Botón para regresar la sidebar -->
    <button id="return-sidebar" class="btn btn-primary" style="display: none; position: fixed; top: 50%; left: 170px; transform: translateY(-50%); z-index: 999;">
        <<< </button>

            <div class="main-content">
                <!-- Contenido principal -->
                <h1>Contenido Principal</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec justo leo.</p>
            </div>
            <div class="content-strip"></div>

            <!-- Bootstrap JS y script para el sidebar -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                document.getElementById('toggle-btn').addEventListener('click', function() {
                    var sidebar = document.getElementById('sidebar');
                    var mainContent = document.querySelector('.main-content');
                    var returnSidebarBtn = document.getElementById('return-sidebar');
                    this.classList.toggle('active');
                    mainContent.classList.toggle('active');
                    if (sidebar.style.left === '0px') {
                        sidebar.style.left = '-250px';
                        mainContent.style.marginLeft = '0';
                        this.style.display = 'block'; // Muestra el botón de toggle al cerrar el sidebar
                        setTimeout(function() {
                            returnSidebarBtn.style.display = 'none'; // Oculta el botón de regresar sidebar al cerrar el sidebar
                        }, 300); // Tiempo en milisegundos para ocultar el botón de regresar sidebar
                    } else {
                        sidebar.style.left = '0px';
                        mainContent.style.marginLeft = '190px';
                        this.style.display = 'none'; // Oculta el botón de toggle al abrir el sidebar
                        setTimeout(function() {
                            returnSidebarBtn.style.display = 'block'; // Muestra el botón de regresar sidebar al abrir el sidebar
                        }, 500); // Tiempo en milisegundos para mostrar el botón de regresar sidebar
                    }
                });

                // Función para regresar la sidebar a su posición inicial
                document.getElementById('return-sidebar').addEventListener('click', function() {
                    var sidebar = document.getElementById('sidebar');
                    var mainContent = document.querySelector('.main-content');
                    var toggleBtn = document.getElementById('toggle-btn');
                    this.style.display = 'none'; // Oculta el botón de regresar sidebar
                    sidebar.style.left = '-250px'; // Mueve la sidebar fuera del área visible
                    mainContent.style.marginLeft = '0'; // Restablece el margen del contenido principal
                    toggleBtn.style.display = 'block'; // Muestra el botón de toggle
                });

                document.addEventListener('DOMContentLoaded', function() {
                    var returnSidebarBtn = document.getElementById('return-sidebar');
                    returnSidebarBtn.style.opacity = '1'; // Hace visible el botón al cargar la página
                    returnSidebarBtn.style.animation = 'fadeIn 0.5s ease'; // Aplica la animación al aparecer
                });


                var toggleBtn = document.getElementById('toggle-btn');

                toggleBtn.addEventListener('mouseenter', function() {
                    this.style.color = 'gray'; // Cambia el color al pasar el cursor
                });

                toggleBtn.addEventListener('mouseleave', function() {
                    this.style.color = 'black'; // Restaura el color al salir del cursor
                });
            </script>

</body>

</html>