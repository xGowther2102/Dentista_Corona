<style>
    .container h1 {
        color: #000;
        /* Cambiar color del título */
    }

    .grafica-container {
        margin-bottom: 15px;
    }

    /* Estilos para las gráficas */
    .grafica-container canvas {
        border: 1px solid rgba(0, 0, 0, 0.3);
        background-color: rgba(0, 0, 0, 0.030);
        /* Color y estilo del borde */
        border-radius: 8px;
        /* Borde redondeado */
    }

    /* Estilos para la tabla */
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        /* Colapsar bordes de celdas */
        background-color: rgba(0, 0, 0, 0.10);
        /* Fondo blanco */
    }

    .table-custom th,
    .table-custom td {
        border: 1px solid #dee2e6;
        padding: .98rem;
        /* Espaciado interno de las celdas */
        text-align: center;
        /* Alinear contenido al centro */
    }

    .table-custom th {
        background-color: #f8f9fa;
        /* Color de fondo para las cabeceras */
    }

    .table-custom td:first-child {
        font-weight: bold;
        /* Texto en negrita para la primera columna */
    }

    .table-custom td:not(:first-child) {
        text-transform: capitalize;
        /* Convertir el texto en mayúscula */
    }

    .modal-header {
        color: #000;
    }

    .modal-body #descripcionModal {
        color: #000;
    }

    .dark-mode .modal-header #confirmModalLabel,
    #descripcionModal {
        color: #fff;
    }

    .dark-mode .modal-content {
        background-color: #222;
        border-color: #234;
    }

    .dark-mode .modal-header {
        border-color: #234;
    }

    .dark-mode .modal-footer {
        border-color: #234;
    }

    .dark-mode .container h1 {
        color: #fff;
        /* Cambiar color del título */
    }

    .dark-mode .grafica-container {
        margin-bottom: 15px;
        /* Espacio entre las gráficas */
        /* Color y estilo del borde */
        color: #fff;
    }

    .dark-mode .grafica-container canvas {
        border: 1px solid rgba(255, 255, 255, 0.5);
        color: #fff;
        background-color: rgba(255, 255, 255, 0.030);
    }
</style>