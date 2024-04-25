<style>
    #fecha-hora-container {
        position: fixed;
        top: 10px;
        left: auto;
        background-color: rgba(50, 65, 110, 0.8);
        color: #FFFFFF;
        padding: 5px 10px;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        z-index: 1000;
        max-width: 200px; /* Ancho máximo del contenedor */
        white-space: nowrap; /* Evitar el salto de línea */
        overflow: hidden; /* Ocultar el texto que excede el ancho */
        text-overflow: ellipsis; /* Mostrar puntos suspensivos si el texto excede el ancho */
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
