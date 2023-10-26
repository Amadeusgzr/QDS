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
  if(url.includes("Backoffice") || url.includes("Almacenero") || url.includes("Camionero")){
    document.querySelector(".aop1-ingresado").textContent = data.aop1_no_index;
  }
  if(url.includes("Backoffice") && url.includes("index")){
    
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

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;

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
  else if(url.includes("Backoffice") && url.includes("op-almacen-cliente")){

    document.querySelector(".h1-tabla").textContent = data.h2_almacen_cliente;
    document.querySelector("#th1-almacen-cliente").textContent = data.th1_almacen_cliente;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("almacen_cliente")){

    document.querySelector(".legend-baja-almacen-cliente").textContent = data.legend_baja_almacen_cliente;
    document.querySelector(".adv").textContent = data.adv_almacen;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_almacen;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("modificar-almacen-cliente")){

    document.querySelector(".legend-m-almacen-cliente").textContent = data.legend_m_almacen_cliente;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_almacen;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("almacen_cliente")){

    document.querySelector(".legend-c-almacen-cliente").textContent = data.legend_c_almacen_cliente;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_almacen;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("op-plataforma")){

    document.querySelector(".h1-tabla").textContent = data.h2_plataforma;
    document.querySelector("#th1-plataformas").textContent = data.th1_plataformas;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("plataforma")){

    document.querySelector(".legend-baja-plataforma").textContent = data.legend_baja_plataforma;
    document.querySelector(".adv").textContent = data.adv_plataforma;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_plataforma;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("modificar-plataforma")){

    document.querySelector(".legend-m-plataforma").textContent = data.legend_m_almacen_cliente;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_plataforma;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-departamento").textContent = data.p_departamento;
    document.querySelector(".p-volumen-maximo").textContent = data.p_volumen_maximo;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("plataforma")){

    document.querySelector(".legend-c-plataforma").textContent = data.legend_c_plataforma;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_plataforma;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-departamento").textContent = data.p_departamento;
    document.querySelector(".p-volumen-maximo").textContent = data.p_volumen_maximo;
    document.querySelector(".p-trayecto").textContent = data.p_trayecto;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("op-empresas-cliente")){

    document.querySelector(".h1-tabla").textContent = data.h2_empresas_cliente;
    document.querySelector(".th1-empresa-cliente").textContent = data.th1_empresa_cliente;
    document.querySelector(".th2-empresa-cliente").textContent = data.th2_empresa_cliente;
    document.querySelector(".th3-empresa-cliente").textContent = data.th3_empresa_cliente;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("empresa_cliente")){

    document.querySelector(".legend-baja-empresa").textContent = data.legend_baja_empresa;
    document.querySelector(".adv").textContent = data.adv_empresa;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_empresa;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-cedula").textContent = data.p_rut;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("modificar-empresa-cliente")){

    document.querySelector(".legend-m-empresa-cliente").textContent = data.legend_m_empresa_cliente;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_empresa;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-cedula").textContent = data.p_rut;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("empresa_cliente")){

    document.querySelector(".legend-c-empresa-cliente").textContent = data.legend_c_empresa_cliente;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_empresa;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-cedula").textContent = data.p_rut;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  if(url.includes("Almacenero") && url.includes("index")){
    
    document.querySelector("#op1 h2").textContent = data.op1_almacenero_h2;
    document.querySelector("#op1 p").textContent = data.op1_almacenero_p;
    document.querySelector("#op2 h2").textContent = data.op2_almacenero_h2;
    document.querySelector("#op2 p").textContent = data.op2_almacenero_p;
    document.querySelector("#op3 h2").textContent = data.op3_almacenero_h2;
    document.querySelector("#op3 p").textContent = data.op3_almacenero_p;
    document.querySelector("#op4 h2").textContent = data.op4_almacenero_h2;
    document.querySelector("#op4 p").textContent = data.op4_almacenero_p;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Almacenero") && url.includes("op-paquetes")){

    document.querySelector(".h1-tabla").textContent = data.h2_paquetes;
    document.querySelector(".th1-paquetes").textContent = data.th1_paquetes;
    document.querySelector(".th2-paquetes").textContent = data.th2_paquetes;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;

  }
  else if(url.includes("Almacenero") && url.includes("baja-paquete")){

    document.querySelector(".legend-baja-paquete").textContent = data.legend_baja_paquete;
    document.querySelector(".adv").textContent = data.adv_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-mail-d").textContent = data.p_mail_d;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    document.querySelector(".p-tipo").textContent = data.p_tipo;
    document.querySelector(".p-estado").textContent = data.p_estado;
    document.querySelector(".p-detalles").textContent = data.p_detalles;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Almacenero") && url.includes("modificar-paquete")){

    document.querySelector(".legend-m-paquete").textContent = data.legend_m_paquete;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    document.querySelector(".p-estado").textContent = data.p_estado;
    document.querySelector(".subtitulo-crud-2").textContent = data.subtitulo_2;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Almacenero") && url.includes("consultar-paquete")){

    document.querySelector(".legend-c-paquete").textContent = data.legend_c_paquete;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-mail-d").textContent = data.p_mail_d;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    document.querySelector(".p-tipo").textContent = data.p_tipo;
    document.querySelector(".p-estado").textContent = data.p_estado;
    document.querySelector(".p-detalles").textContent = data.p_detalles;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }

}


window.addEventListener("DOMContentLoaded", () => {
  if (!idiomaSeleccionado) {
    // Si no hay idioma seleccionado en localStorage, se carga el idioma por defecto (español)
    cargarTextos("español");
  }
});