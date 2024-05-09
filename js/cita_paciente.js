function registrarCita() {
    var nombre = $('#nombre').val();
    var apellidoP = $('#apellidoP').val();
    var apellidoM = $('#apellidoM').val();
    var date = $('#date').val();
    var tratamiento = $('#tratamiento').val();

    if (nombre !== '' && apellidoP !== '' && apellidoM !== '' && date !== '' && tratamiento !== '') {
        $.ajax({
            type: 'POST',
            url: '../conexion/registro_citas.php',
            data: {
                nombre: nombre,
                apellidoP: apellidoP,
                apellidoM: apellidoM,
                date: date,
                tratamiento: tratamiento
            },
            success: function (response) {
                // Si la inserción es exitosa, mostrar SweetAlert de éxito
                Swal.fire({
                    title: 'Éxito!',
                    text: 'Cita insertada correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    // Recargar la página después de aceptar el mensaje
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function () {
                // Si hay algún error, mostrar SweetAlert de error
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un error al insertar la cita. Por favor, inténtelo de nuevo más tarde.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    } else {
        $('#errorModal').modal('show');
    }
}