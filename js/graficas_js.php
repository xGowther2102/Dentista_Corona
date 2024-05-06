<script>
// Datos para los gráficos
var ctxComodidad = document.getElementById('graficoComodidad').getContext('2d');
var ctxTiempo = document.getElementById('graficoTiempo').getContext('2d');
var ctxAtencion = document.getElementById('graficoAtencion').getContext('2d');

var dataComodidad = {
    labels: ['Insatisfecho', 'Poco satisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'],
    datasets: [{
        label: 'Comodidad y Limpieza',
        data: [<?php echo implode(',', $nivelesComodidad); ?>],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
    }]
};

var dataTiempo = {
    labels: ['Insatisfecho', 'Poco satisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'],
    datasets: [{
        label: 'Tiempo de Espera',
        data: [<?php echo implode(',', $nivelesTiempo); ?>],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
    }]
};

var dataAtencion = {
    labels: ['Insatisfecho', 'Poco satisfecho', 'Neutral', 'Satisfecho', 'Muy satisfecho'],
    datasets: [{
        label: 'Atención del Doctor',
        data: [<?php echo implode(',', $nivelesAtencion); ?>],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
    }]
};

var options = {
    scales: {
        x: {
            ticks: {
                color: 'green' // Cambiar el color de los labels del eje X
            }
        },
        y: {
            beginAtZero: true,
            ticks: {
                stepSize: 1, // Cambiar el paso de los ticks según tu necesidad
                callback: function(value) {
                    return value; // Mostrar valores absolutos en lugar de porcentajes
                },
                color: 'green' // Cambiar el color de los labels del eje Y
            }
        }
    },
    plugins: {
        title: {
            display: true,
            text: '',
            color: 'red' // Cambiar el color del título de la gráfica
        }
    }
};

// Crear los gráficos de barras
var graficoComodidad = new Chart(ctxComodidad, {
    type: 'bar',
    data: dataComodidad,
    options: Object.assign({}, options, {
        plugins: {
            title: {
                text: 'Comodidad y Limpieza',
                color: 'orange' // Cambiar el color del título de la gráfica
            }
        }
    })
});

var graficoTiempo = new Chart(ctxTiempo, {
    type: 'bar',
    data: dataTiempo,
    options: Object.assign({}, options, {
        plugins: {
            title: {
                text: 'Tiempo de Espera',
                color: 'purple' // Cambiar el color del título de la gráfica
            }
        }
    })
});

var graficoAtencion = new Chart(ctxAtencion, {
    type: 'bar',
    data: dataAtencion,
    options: Object.assign({}, options, {
        plugins: {
            title: {
                text: 'Atención del Doctor',
                color: 'green' // Cambiar el color del título de la gráfica
            }
        }
    })
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>