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
    xhr.open("POST", "../../../Dentista_Corona/assets/conexion/verificar_correo_pswd.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        console.log("Estado de la solicitud:", xhr.readyState); // Para verificar el estado de la solicitud
        console.log("Respuesta del servidor:", xhr.responseText); // Para verificar la respuesta del servidor
        if (xhr.status === 200) {
          // Verificar la respuesta del servidor
          if (xhr.responseText === "exists") {
            // El correo existe en la base de datos, permite el envío del formulario de cambio de contraseña
            console.log("Enviando formulario de cambio de contraseña...");
            document.getElementById("passwordResetForm").submit();
          } else {
            // El correo no existe en la base de datos, muestra un mensaje
            alert("El correo ingresado no existe, verifique su correo.");
          }
        } else {
          // Manejar errores de conexión o del servidor
          alert(
            "Hubo un problema al verificar el correo. Inténtalo de nuevo más tarde."
          );
        }
      }
    };
    // Enviar el correo al servidor para verificar su existencia
    xhr.send("verificarCorreo=" + email); // Modificar el nombre del parámetro para que coincida con el backend
  
    return false; // Evita el envío del formulario
  }
  