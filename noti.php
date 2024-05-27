<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert con sonido recurrente</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        function showAlert() {
            // Mostrar la alerta de SweetAlert
            Swal.fire({
                title: '¡Notificación!',
                text: 'Esto es una alerta con sonido.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });

            // Reproducir sonido
            
            const audio = new Audio('beep-07.mp3');
            audio.play();

            if ('Notification' in window) {
  Notification.requestPermission().then(function(result) {
    if (result === 'granted') {
      new Notification('¡Hola!', {
        body: 'Este es un ejemplo de notificación web.',
        icon: 'https://www.example.com/icon.png'
      });
    } else {
      console.error('Las notificaciones no están permitidas.');
    }
  });
} else {
  console.error('Las notificaciones no son compatibles con este navegador.');
}
        }

        function showBrowserNotification() {
            const notification = new Notification('¡Notificación!', {
                body: 'Esto es una alerta con sonido.'
            });

            // Reproducir sonido al recibir la notificación
            notification.onshow = () => {
                const audio = new Audio('beep-07.mp3');
                audio.play();
            };
        }

        // Ejecutar la función showAlert cada 5 segundos
        setInterval(showAlert, 5000);
    </script>
</body>
</html>
