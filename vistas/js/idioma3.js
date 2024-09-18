let url = location.href;
const chkIdioma = document.querySelector("#btn-idioma");

let idioma = "español";
let idiomaSeleccionado = localStorage.getItem("idioma");
chkIdioma.checked = idiomaSeleccionado === "ingles";

console.log(location.pathname)

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
  document.querySelector(".aop1-ingresado").textContent = data.aop1_index;
  document.querySelector(".aop3-ingresado").textContent = data.aop3_index;
  document.querySelector(".aop4-ingresado").textContent = data.aop4_index;
  if(url.includes("cambiar-contrasenia")){
    document.querySelector(".h1-tabla2").textContent = data.h1_cambiar_contrasenia;
    document.querySelector(".adv").textContent = data.adv_cambiar_contrasenia;    
    document.querySelector(".txt1").placeholder = data.txt1_cambiar_contrasenia;    
    document.querySelector(".txt2").placeholder = data.txt2_cambiar_contrasenia;    
    document.querySelector(".txt3").placeholder = data.txt3_cambiar_contrasenia;    
    document.querySelector(".boton-siguiente").value = data.boton_confirmar;    
    document.querySelector(".boton-volver").textContent = data.btn_volver;    
  }
  else if(url.includes("aplicacion-seguimiento")){

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