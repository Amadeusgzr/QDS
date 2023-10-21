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
    idioma = "español";
  }

  localStorage.setItem("idioma", idioma);
  cargarTextos(idioma);
});

function cargarTextos(lang) {
  const url = "../js/json/" + lang + ".json";
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
  if(url.includes("Backoffice") && url.includes("index")){
    console.log("Hola");
    
    document.querySelector("#op1 h2").textContent = data.op1_h2;
    document.querySelector("#op1 p").textContent = data.op1_p;
    document.querySelector("#op2 h2").textContent = data.op2_h2;
    document.querySelector("#op2 p").textContent = data.op2_p;
    document.querySelector("#op3 h2").textContent = data.op3_h2;
    document.querySelector("#op3 p").textContent = data.op3_p;
    document.querySelector("#op4 h2").textContent = data.op4_h2;
    document.querySelector("#op4 p").textContent = data.op4_p;
    document.querySelector("#op5 h2").textContent = data.op5_h2;
    document.querySelector("#op5 p").textContent = data.op5_p;
    document.querySelector("#op6 h2").textContent = data.op6_h2;
    document.querySelector("#op6 p").textContent = data.op6_p;
    document.querySelector("#op7 h2").textContent = data.op7_h2;
    document.querySelector("#op7 p").textContent = data.op7_p;

  }
  else if(url.includes("Backoffice") && url.includes("op-camioneros")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_camioneros;
    document.querySelector(".th1").textContent = data.th1_camioneros;
    document.querySelector(".th2").textContent = data.th2_camioneros;
    let btnsOp = Array.from(document.querySelectorAll(".btn-op"));
    btnsOp.forEach(btn =>{
      if(btn.classList.contains("btn-op1")){
        btn.textContent = data.btn_op1;
      } else if (btn.classList.contains("btn-op2")){
        btn.textContent = data.btn_op2;
      } else if (btn.classList.contains("btn-op3")){
        btn.textContent = data.btn_op3;
      }
    })
    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;

  }
  else if(url.includes("Backoffice") && url.includes("alta-camionero")){

    document.querySelector(".legend-form").textContent = data.legend_camionero;
    document.querySelector(".txt-1").placeholder = data.cedula;
    document.querySelector(".txt-2").placeholder = data.nombre;
    document.querySelector(".txt-3").placeholder = data.telefono;
    document.querySelector(".boton-agregar").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("camionero")){

    document.querySelector(".legend-baja").textContent = data.legend_baja_camionero;
    document.querySelector(".adv").textContent = data.adv_camionero;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camionero;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-cedula").textContent = data.p_cedula;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("modificar-camionero")){

    document.querySelector(".legend-m-camionero").textContent = data.legend_m_camionero;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camionero;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-cedula").textContent = data.p_cedula;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-telefono").textContent = data.p_telefono;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;

  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("camionero")){

    document.querySelector(".legend-c-camionero").textContent = data.legend_c_camionero;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camionero;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-cedula").textContent = data.p_cedula;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-telefono").textContent = data.p_telefono;

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-camiones")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_camiones;
    document.querySelector("#th1-camion").textContent = data.th1_camiones;
    document.querySelector("#th2-camion").textContent = data.th2_camiones;
    let btnsOp = Array.from(document.querySelectorAll(".btn-op"));
    btnsOp.forEach(btn =>{
      if(btn.classList.contains("btn-op1")){
        btn.textContent = data.btn_op1;
      } else if (btn.classList.contains("btn-op2")){
        btn.textContent = data.btn_op2;
      } else if (btn.classList.contains("btn-op3")){
        btn.textContent = data.btn_op3;
      }
    })
    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;

  }
  else if(url.includes("Backoffice") && url.includes("alta-camion")){

    document.querySelector(".legend-form").textContent = data.legend_camion;
    document.querySelector(".txt-1").placeholder = data.matrîcula;
    document.querySelector(".txt-2").placeholder = data.peso_max;
    document.querySelector(".txt-3").placeholder = data.vol_max;

    document.querySelector(".boton-agregar").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("camion")){

    document.querySelector(".legend-baja").textContent = data.legend_baja_camion;
    document.querySelector(".adv").textContent = data.adv_camion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camion;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("modificar-camion")){

    document.querySelector(".legend-m-camion").textContent = data.legend_m_camion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camion;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("camion")){

    document.querySelector(".legend-c-camion").textContent = data.legend_c_camion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camion;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("op-almacenes")){

    document.querySelector(".h1-titulo").textContent = data.h1_titulo_almacenes;
    document.querySelector(".h2-almacen-central").textContent = data.h2_almacen_central;
    document.querySelector(".h2-almacen-cliente").textContent = data.h2_almacen_cliente;
    document.querySelector(".h2-plataforma").textContent = data.h2_plataforma;

    document.querySelector(".boton-volver").textContent = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("op-almacen-central")){

    document.querySelector(".h1-tabla").textContent = data.h2_almacen_central;
    document.querySelector("#th1-almacen-central").textContent = data.th1_almacen_central;
    let btnsOp = Array.from(document.querySelectorAll(".btn-op"));
    btnsOp.forEach(btn =>{
      if(btn.classList.contains("btn-op1")){
        btn.textContent = data.btn_op1;
      } else if (btn.classList.contains("btn-op2")){
        btn.textContent = data.btn_op2;
      } else if (btn.classList.contains("btn-op3")){
        btn.textContent = data.btn_op3;
      }
    })
    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
  }
  else if(url.includes("Backoffice") && url.includes("alta-almacen-central")){

    document.querySelector(".legend-form").textContent = data.legend_almacen_central;
    document.querySelector(".txt-1").placeholder = data.telefono;
    document.querySelector(".txt-2").placeholder = data.numero_almacen;

    document.querySelector(".boton-agregar").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("almacen_central")){

    document.querySelector(".legend-baja").textContent = data.legend_baja_almacen_central;
    document.querySelector(".adv").textContent = data.adv_almacen;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_almacen;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-numero-almacen").textContent = data.p_numero_almacen;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("modificar-almacen-central")){

    document.querySelector(".legend-m-almacen-central").textContent = data.legend_m_almacen_central;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_almacen;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-numero-almacen").textContent = data.p_numero_almacen;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("almacen_central")){

    document.querySelector(".legend-c-almacen-central").textContent = data.legend_c_almacen_central;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_almacen;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-numero-almacen").textContent = data.p_numero_almacen;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
}


window.addEventListener("DOMContentLoaded", () => {
  if (!idiomaSeleccionado) {
    // Si no hay idioma seleccionado en localStorage, se carga el idioma por defecto (español)
    cargarTextos("español");
  }
});