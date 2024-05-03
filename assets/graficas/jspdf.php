<?php
// Incluye la librería jsPDF
require_once '../../js/pdf.php';

// Crear un nuevo documento PDF
$doc = new jsPDF();

// Agregar contenido al PDF
$doc->text('RESULTADOS DE ENCUESTA', 10, 10); // Título del PDF
$doc->text('Total de Encuestados: ' . $_GET['total_encuestados'], 10, 20); // Datos de la tabla
$doc->text('Ultima vez: ' . $_GET['ultimo_id'], 10, 30); // Otros datos de la tabla

// Mostrar el PDF en la nueva pestaña
$doc->output('dataurlnewwindow');
?>