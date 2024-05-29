const palanca = document.querySelector(".switch");
const circulo = document.querySelector(".circulo");
const body = document.body;

// Verificar si el modo oscuro estaba activado anteriormente o establecerlo por defecto
let darkModeEnabled = localStorage.getItem("darkModeEnabled");

// Si darkModeEnabled es null, significa que no hay un valor guardado. Lo establecemos en "true" para activar el modo oscuro por defecto.
if (darkModeEnabled === null) {
  darkModeEnabled = "true";
  localStorage.setItem("darkModeEnabled", "true");
}

if (darkModeEnabled === "true") {
  body.classList.add("dark-mode");
  circulo.classList.add("prendido");
}

palanca.addEventListener("click", () => {
  // Cambiar el estado del modo oscuro
  const isDarkMode = body.classList.toggle("dark-mode");
  circulo.classList.toggle("prendido");

  // Guardar el estado en localStorage
  localStorage.setItem("darkModeEnabled", isDarkMode ? "true" : "false");
});

const cloud = document.getElementById("cloud");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");

menu.addEventListener("click", () => {
  barraLateral.classList.toggle("max-barra-lateral");
  if (barraLateral.classList.contains("max-barra-lateral")) {
    menu.children[0].style.display = "none";
    menu.children[1].style.display = "block";
  } else {
    menu.children[0].style.display = "block";
    menu.children[1].style.display = "none";
  }
  if (window.innerWidth <= 320) {
    barraLateral.classList.add("mini-barra-lateral");
    main.classList.add("min-main");
    spans.forEach((span) => {
      span.classList.add("oculto");
    });
  }
});

cloud.addEventListener("click", () => {
  barraLateral.classList.toggle("mini-barra-lateral");
  main.classList.toggle("min-main");
  spans.forEach((span) => {
    span.classList.toggle("oculto");
  });
});
