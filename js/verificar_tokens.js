document.addEventListener("DOMContentLoaded", (event) => {
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("password");
  const toggleConfirmPassword = document.getElementById(
    "toggleConfirmPassword"
  );
  const confirmPassword = document.getElementById("confirm_password");

  togglePassword.addEventListener("click", function () {
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.textContent = type === "password" ? "👁️" : "👁️";
  });

  toggleConfirmPassword.addEventListener("click", function () {
    const type =
      confirmPassword.getAttribute("type") === "password" ? "text" : "password";
    confirmPassword.setAttribute("type", type);
    this.textContent = type === "password" ? "👁️" : "👁️";
  });

  document
    .getElementById("cambiarContrasenaForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      let contrasena = password.value;
      let confirmarContrasena = confirmPassword.value;
      let passwordError = document.getElementById("passwordError");
      let confirmPasswordError = document.getElementById(
        "confirmPasswordError"
      );

      let valid = true;

      // Validación de la contraseña utilizando una expresión regular
      let strongRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()-_]).{8,}$/;
      if (!strongRegex.test(contrasena)) {
        passwordError.innerHTML =
          "La contraseña debe tener al menos 8 caracteres con al menos una mayúscula y un número.";
        passwordError.classList.remove("d-none"); // Mostrar el mensaje de error
        valid = false;
      } else {
        passwordError.innerHTML = ""; // Restablecer el mensaje
        passwordError.classList.add("d-none"); // Ocultar el mensaje de error
      }

      if (contrasena !== confirmarContrasena) {
        confirmPasswordError.innerHTML = "Las contraseñas no coinciden.";
        confirmPasswordError.classList.remove("d-none"); // Mostrar el mensaje de error
        valid = false;
      } else {
        confirmPasswordError.innerHTML = ""; // Restablecer el mensaje
        confirmPasswordError.classList.add("d-none"); // Ocultar el mensaje de error
      }

      // Si la contraseña es válida y coincide con la confirmación, enviar el formulario para procesar el cambio
      if (valid) {
        this.submit();
      }
    });
});
