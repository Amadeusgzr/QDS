const chkIdioma = document.querySelector("#btn-idioma");

let idioma = "español";
let idiomaSeleccionado = localStorage.getItem("idioma");
chkIdioma.checked = idiomaSeleccionado === "ingles";

console.log(location.pathname);

if (idiomaSeleccionado) {
  cargarTextos(idiomaSeleccionado);
}

chkIdioma.addEventListener("click", () => {
  if (chkIdioma.checked) {
    idioma = "ingles";
  } else {
    idioma = "espanol";
  }

  localStorage.setItem("idioma", idioma);
  cargarTextos(idioma);
});

function cargarTextos(lang) {
  const url = "js/json/" + lang + ".json";
  const request = new XMLHttpRequest();
  request.open("GET", url, true);
  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      const data = JSON.parse(request.responseText);
      actualizarTextos(data);
    } else if (request.readyState === 4 && request.status !== 200) {
      console.error("Error al cargar el archivo JSON");
    }
  };
  request.send();
}

function actualizarTextos(data) {
  document.querySelector(".aop1-index").textContent = data.aop1_index_no_login;
  document.querySelector(".aop2-index").textContent = data.aop2_index_no_login;
  document.querySelector(".aop3-index").textContent = data.aop3_index_no_login;

  document.querySelector("#boton-login").value = data.btn_login;

  document.querySelector("#h1-login").textContent = data.h1_login;
  document.querySelector(".txt1").placeholder = data.input_nombre_login;
  document.querySelector(".txt2").placeholder = data.input_contrasenia_login;

  document.querySelector("#submit-login").value = data.submit_login;
  document.querySelector("#a-contrasenia").textContent = data.olvidaste_tu_contrasenia;

}

window.addEventListener("DOMContentLoaded", () => {
  if (!idiomaSeleccionado) {
    // Si no hay idioma seleccionado en localStorage, se carga el idioma por defecto (español)
    cargarTextos("español");
  }
});