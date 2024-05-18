$(document).ready(function(){
    $('#regiPaciente').submit(function(e){
        e.preventDefault(); // Evitar que el formulario se envíe de forma convencional

        // Obtener los valores de los campos del formulario
        var nombre = $('#nombre').val();
        var apellidoP = $('#apellidoP').val();
        var apellidoM = $('#apellidoM').val();
        var telefono = $('#telefono').val();
        var correo = $('#correo').val();
        var fechaNacimiento = $('#fechaNacimiento').val();
        var direccion = $('#direccion').val();
        var sexo = $('#sexo').val();
        var historial = $('#historial').val();

        // Objeto con los datos a enviar al servidor
        var datos = {
            nombre: nombre,
            apellidoP: apellidoP,
            apellidoM: apellidoM,
            telefono: telefono,
            correo: correo,
            fechaNacimiento: fechaNacimiento,
            direccion: direccion,
            sexo: sexo,
            historial: historial
        };

        // Enviar los datos al servidor mediante AJAX
        $.ajax({
            type: 'POST',
            url: '../../assets/pacientes/registro_paciente.php', // Ruta del script PHP que procesará los datos
            data: datos,
            success: function(response){
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El paciente ha sido registrado correctamente.'
                });
                
                // Limpiar los campos del formulario después del registro
                $('#regiPaciente')[0].reset();
            },
            error: function(xhr, status, error){
                // Mostrar mensaje de error con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al registrar al paciente. Por favor, inténtalo de nuevo.'
                });
            }
        });
    });
});
