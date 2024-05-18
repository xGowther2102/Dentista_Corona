const botonesEnvio = document.querySelectorAll('[id^="boton-envio-"]');

botonesEnvio.forEach(botonEnvio => {
  const id = botonEnvio.id.split('-')[2]; // Extraer el identificador único
  const mensaje = document.getElementById('mensaje-boton-envio-' + id);

  botonEnvio.addEventListener('mouseover', () => {
    mensaje.classList.remove('oculto');
  });

  botonEnvio.addEventListener('mouseout', () => {
    mensaje.classList.add('oculto');
  });
});
