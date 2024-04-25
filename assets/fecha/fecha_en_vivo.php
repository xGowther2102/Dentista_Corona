<style>
    #fecha-hora-container {
        position: fixed; /* Cambiado a posicionamiento fijo */
        top: 10px;
        left: 10px;
        background-color: rgba(50, 65, 110, 0.8); /* Fondo semi-transparente */
        color: #FFFFFF;
        padding: 5px 10px;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        z-index: 1000; /* Z-index alto para estar encima de otros elementos */
    }

    .dark-mode #fecha-hora-container {
        background-color: rgba(43, 63, 104, 0.8);
    }
</style>

<div id="fecha-hora-container"></div>

<script>
    function mostrarFechaHora() {
        const fechaHoraContainer = document.getElementById('fecha-hora-container');
        if (fechaHoraContainer) {
            const fechaHoraActual = new Date();
            const optionsFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const optionsHora = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
            const fechaTexto = fechaHoraActual.toLocaleDateString('es-ES', optionsFecha);
            let horaTexto = fechaHoraActual.toLocaleTimeString('es-ES', optionsHora);
            horaTexto = horaTexto.toUpperCase(); // Convertir a mayúsculas
            fechaHoraContainer.innerHTML = `${horaTexto} - ${fechaTexto}`;
        }
    }

    // Llama a la función para mostrar la fecha y hora actual cada segundo
    setInterval(mostrarFechaHora, 1000);
</script>
