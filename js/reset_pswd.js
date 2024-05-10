function validarCorreoElectronico(event) {
  event.preventDefault(); // Evita el envío del formulario por defecto

  let email = document.getElementById("correo").value;
  let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  let invalidCharsRegex = /[!#$%^&*()+=\[\]{};':"\\|,<>\/?]+/;

  console.log("Email ingresado:", email); // Para verificar qué correo se está enviando
  console.log("Email válido según regex:", emailRegex.test(email)); // Verificar si el correo cumple con el formato

  if (email.trim() === "") {
      alert("Por favor, ingresa tu correo electrónico.");
      return false;
  }

  if (invalidCharsRegex.test(email)) {
      alert("El correo electrónico contiene caracteres inválidos.");
      return false;
  }

  if (!emailRegex.test(email)) {
      alert("Por favor, ingresa un correo electrónico válido.");
      return false;
  }

  // Realizar la verificación en el servidor mediante una solicitud AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../../../Dentista_Corona/assets/conexion/reset_pswd.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          console.log("Estado de la solicitud:", xhr.readyState); // Para verificar el estado de la solicitud
          console.log("Respuesta del servidor:", xhr.responseText); // Para verificar la respuesta del servidor
          if (xhr.status === 200) {
              // Mostrar el modal de éxito
              $("#successModal").modal("show");
          } else {
              // Manejar errores de conexión o del servidor
              alert(
                  "Hubo un problema al enviar el formulario. Inténtalo de nuevo más tarde."
              );
          }
      }
  };
  // Enviar el correo al servidor para realizar el proceso de restablecimiento
  xhr.send("correo=" + email); // Modificar el nombre del parámetro según lo esperado por reset_pswd.php

  return false; // Evita el envío del formulario
}

