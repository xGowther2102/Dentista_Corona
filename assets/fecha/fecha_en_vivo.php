<style>
    #fecha-hora-container {
        position: static;
        /* Cambiado a posicionamiento fijo */
        top: 90%;
        left: 50%;
        background-color: #eeeeee;
        color: #1C3059;
        border-radius: 11px;
        /* Añadir bordes redondeados */
        border-color: #010e28;
        padding: 15px;
        /* Añadir espacio interno */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        /* Añadir sombra */
        /* Fondo semi-transparente */
        color: #222;
        font-family: Arial, sans-serif;
        font-size: 14px;
        z-index: 1000;
        /* Z-index alto para estar encima de otros elementos */
        margin-bottom: 10%
    }

    .dark-mode #fecha-hora-container {
        background-color: rgba(43, 63, 104, 0.2);
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
        color: #fff;
    }
</style>

<div id="fecha-hora-container">
</div>

<script>
    function mostrarFechaHora() {
        const fechaHoraContainer = document.getElementById('fecha-hora-container');
        if (fechaHoraContainer) {
            const fechaHoraActual = new Date();
            const optionsFecha = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const optionsHora = {
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            const fechaTexto = fechaHoraActual.toLocaleDateString('es-ES', optionsFecha);
            let horaTexto = fechaHoraActual.toLocaleTimeString('es-ES', optionsHora);
            horaTexto = horaTexto.toUpperCase(); // Convertir a mayúsculas
            fechaHoraContainer.innerHTML = `${horaTexto} - ${fechaTexto}`;
        }
    }

    // Llama a la función para mostrar la fecha y hora actual cada segundo
    setInterval(mostrarFechaHora, 1000);
</script>