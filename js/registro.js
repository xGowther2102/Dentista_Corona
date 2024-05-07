// Definición de showAlertModal fuera del evento DOMContentLoaded
function showAlertModal(message) {
  const avisoModal = new bootstrap.Modal(
    document.getElementById("avisoModal"),
    {
      keyboard: false,
    }
  );
  const avisoModalBody = document.getElementById("avisoModalBody");
  avisoModalBody.textContent = message;
  avisoModal.show();

  // Deshabilitar el botón de Registrar
  document.getElementById("btnRegistrar").disabled = true;
}

document
  .getElementById("registroForm")
  .addEventListener("submit", function (event) {
    const user = document.getElementById("user").value.trim();
    const correo = document.getElementById("correo").value.trim();

    // Bloquear el envío si el usuario o correo ya existen
    if (user === "usuario_existente" || correo === "correo_existente") {
      showAlertModal(
        "El usuario o correo electrónico ya existen. Por favor, utiliza otros datos."
      );
      event.preventDefault(); // Evita el envío del formulario
    }
  });

// Evento change para el campo de usuario
document.getElementById("user").addEventListener("change", function () {
  const user = this.value.trim();
  if (user !== "") {
    $.post(
      "../../../Dentista_Corona/assets/conexion/verificar_usuario.php",
      {
        verificarUsuario: user,
      },
      function (data) {
        if (data === "exists") {
          showAlertModal(
            "El usuario ya existe. Por favor, elige otro nombre de usuario."
          );
          document.getElementById("btnRegistrar").disabled = true;
        } else {
          document.getElementById("btnRegistrar").disabled = false;
        }
      }
    );
  }
});

// Evento input para el campo de correo
document.getElementById("correo").addEventListener("input", function () {
  const correo = this.value.trim();
  if (correo !== "") {
    $.post(
      "../../../Dentista_Corona/assets/conexion/verificar_usuario.php",
      {
        verificarCorreo: correo,
      },
      function (data) {
        if (data === "exists") {
          showAlertModal(
            "El correo electrónico ya está registrado. Por favor, utiliza otro correo."
          );
          document.getElementById("btnRegistrar").disabled = true;
        } else {
          document.getElementById("btnRegistrar").disabled = false;
        }
      }
    );
  }
});

document
  .getElementById("registroForm")
  .addEventListener("submit", function (event) {
    const nombre = document.getElementById("nombre").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document
      .getElementById("confirmPassword")
      .value.trim();

    if (!nombre) {
      document.getElementById("nombreError").classList.remove("d-none");
      event.preventDefault();
    } else {
      document.getElementById("nombreError").classList.add("d-none");
    }

    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo)) {
      document.getElementById("correoError").classList.remove("d-none");
      event.preventDefault();
    } else {
      document.getElementById("correoError").classList.add("d-none");
    }

    if (
      password.length < 8 ||
      !/[A-Z]/.test(password) ||
      !/\d/.test(password)
    ) {
      document.getElementById("passwordError").classList.remove("d-none");
      event.preventDefault();
    } else {
      document.getElementById("passwordError").classList.add("d-none");
    }

    if (password !== confirmPassword) {
      document
        .getElementById("confirmPasswordError")
        .classList.remove("d-none");
      event.preventDefault();
    } else {
      document.getElementById("confirmPasswordError").classList.add("d-none");
    }
  });

const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");
togglePassword.addEventListener("click", function () {
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  this.textContent = type === "password" ? "🙈" : "🙉";
});

const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
const confirmPassword = document.getElementById("confirmPassword");
toggleConfirmPassword.addEventListener("click", function () {
  const type =
    confirmPassword.getAttribute("type") === "password" ? "text" : "password";
  confirmPassword.setAttribute("type", type);
  this.textContent = type === "password" ? "🙈" : "🙉";
});
