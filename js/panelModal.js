$('#formulario-actualizar').submit(function(event) {
    event.preventDefault(); 
    var nombreCompleto = $('#nombreCompleto').val();
    var tratamiento = $('#tratamiento').val();
    var antecedentes = $('#antecedentes').val();
    var estatus = $('#estatus').val();
    var fechaHora = $('#fechaHora').val();
    $.ajax({
        type: 'POST', 
        url: 'actualizar_cita.php', 
        data: {
            nombreCompleto: nombreCompleto,
            tratamiento: tratamiento,
            antecedentes: antecedentes,
            estatus: estatus,
            fechaHora: fechaHora
        },
        success: function(response) {
            console.log(response); 
            Swal.fire({
                title: 'Cita Actualizada',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000 
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al actualizar la cita. Por favor, inténtalo de nuevo.',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000 
            });
        }
    });
});
