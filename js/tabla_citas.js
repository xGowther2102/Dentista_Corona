$(document).ready(function () {
  var table = $("#dataTable").DataTable({
    paging: true,
    pageLength: 5, // Mostrar solo 5 datos por página
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "Todos"],
    ],
    language: {
      search:
        '<span style="color: green; background-color: #5f5f5f08; box-shadow: 10%;">Buscar:</span>', // Cambiar color de la caja de búsqueda
      lengthMenu:
        '<span style="color: rgb(153, 153, 153); text-shadow: #303030 10px;">Mostrar _MENU_ entradas por página',
      info: '<span style="color: rgb(153, 153, 153); text-shadow: #303030 10px;">Mostrando _START_ a _END_ de _TOTAL_ entradas',
      infoEmpty: "Mostrando 0 a 0 de 0 entradas",
      zeroRecords: "No se encontraron resultados",
      infoFiltered: "(filtrado de _MAX_ entradas totales)",
      emptyTable: "No hay datos disponibles en la tabla",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: '<span style="color: red;">Anterior</span>',
      },
    },
    pagingType: "simple_numbers", // Mostrar un conjunto limitado de números de página
    dom:
      '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
      '<"row"<"col-sm-12"t>>' +
      '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>', // Ajustar diseño de la tabla
  });

  $("#dataTable tbody").on("click", "button.actualizar-btn", function () {
    var data = table.row($(this).parents("tr")).data();
    // Aquí puedes implementar la lógica para actualizar la fila
    console.log("Actualizar fila:", data);
  });

  $("#dataTable tbody").on("click", "button.eliminar-btn", function () {
    var row = table.row($(this).parents("tr"));
    row.remove().draw();
  });

  $("#exportar-btn").click(function () {
    var data = table.rows().data().toArray();
    var excelData = data.map(function (row) {
      return [
        row[0], // Nombre Completo
        row[1], // Tratamiento
        row[2], // Fecha
      ];
    });

    var excelContent = [
      ["Nombre Completo", "Tratamiento", "Fecha"],
      ...excelData,
    ];

    var csvContent = arrayToCSV(excelContent); // Convertir a CSV

    // Crear blob con encoding UTF-8 para soporte Unicode
    var blob = new Blob([new Uint8Array([0xef, 0xbb, 0xbf]), csvContent], {
      type: "text/csv;charset=utf-8",
    });

    saveAs(blob, "datos_pacientes.csv");
  });

  // Función para convertir array a CSV
  function arrayToCSV(arr) {
    return arr
      .map(function (row) {
        return row
          .map(function (cell) {
            // Reemplazar comillas dobles por dos comillas para escaparlas
            cell = cell.toString().replace(/"/g, '""');
            return '"' + cell + '"';
          })
          .join(",");
      })
      .join("\n");
  }
});
