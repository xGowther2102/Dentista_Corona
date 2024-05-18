$(document).ready(function(){
    $('.eliminar-btn').click(function(){
        var id = $(this).data('id');
        console.log(id);
        
        // Utiliza SweetAlert en lugar de confirm
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, realiza la solicitud AJAX
                $.ajax({
                    url: '../../assets/panel_principal/eliminar_paciente.php',
                    method: 'POST',
                    data: {id: id},
                    success: function(data){
                        // Si la eliminación es exitosa, muestra un mensaje de éxito y recarga la página
                        Swal.fire(
                            'Eliminado!',
                            'El paciente ha sido eliminado.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error){
                        // Si hay un error, muestra un mensaje de error
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'Hubo un error al intentar eliminar al paciente.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});

