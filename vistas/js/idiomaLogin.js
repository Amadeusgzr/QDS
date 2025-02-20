let url = location.href;
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

  if(document.querySelector("#h1-login")){
    document.querySelector("#h1-login").textContent = data.h1_login;
    document.querySelector(".txt1").placeholder = data.input_nombre_login;
    document.querySelector(".txt2").placeholder = data.input_contrasenia_login;

    document.querySelector("#submit-login").value = data.submit_login;
    document.querySelector("#a-contrasenia").textContent = data.olvidaste_tu_contrasenia;

  }

  if(url.includes("nuestroServicio")){
    document.querySelector(".titulo-1").textContent = data.h1_1_nuestro_servicio;
    document.querySelector(".p-1").textContent = data.p_1_nuestro_servicio;
    document.querySelector(".titulo-2").textContent = data.h1_2_nuestro_servicio;
    document.querySelector(".p-2").textContent = data.p_2_nuestro_servicio;

    document.querySelector(".span-1").textContent = data.span_1_nuestro_servicio;
    document.querySelector(".span-2").textContent = data.span_2_nuestro_servicio;
    document.querySelector(".span-3").textContent = data.span_3_nuestro_servicio;
    
  }

  if(url.includes("aplicacion-seguimiento")){

    document.querySelector(".legend-seguimiento").textContent = data.legend_seguimiento;
    document.querySelector(".p-mail-d").textContent = data.p_mail_d;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
  
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    document.querySelector(".p-estado").textContent = data.p_estado;
    if(document.querySelector(".p-tipo")){
      document.querySelector(".p-tipo").textContent = data.p_tipo;
    }
    if(document.querySelector(".p-detalles")){
      document.querySelector(".p-detalles").textContent = data.p_detalles;
    }
    
  }

}

window.addEventListener("DOMContentLoaded", () => {
  if (!idiomaSeleccionado) {
    // Si no hay idioma seleccionado en localStorage, se carga el idioma por defecto (español)
    cargarTextos("español");
  }
});