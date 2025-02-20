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
  if(url.includes("cambiar-contrasenia")){
    document.querySelector(".h1-tabla2").textContent = data.h1_cambiar_contrasenia;
  }
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
    document.querySelector("#op8 h2").textContent = data.op8_h2;
    document.querySelector("#op8 p").textContent = data.op8_p;
    document.querySelector("#op9 h2").textContent = data.op9_h2;
    document.querySelector("#op9 p").textContent = data.op9_p;

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
  else if(url.includes("Backoffice") && url.includes("op-usuarios")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_usuarios;
    document.querySelector(".th1").textContent = data.th1_usuarios;
    document.querySelector(".th2").textContent = data.th2_usuarios;
    document.querySelector(".th3").textContent = data.th3_usuarios;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;

  }
  else if(url.includes("Backoffice") && url.includes("op-camioneros-baja")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_camioneros_baja;
    document.querySelector(".th1").textContent = data.th1_camioneros;
    document.querySelector(".th2").textContent = data.th2_camioneros;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

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
  else if(url.includes("Backoffice") && url.includes("alta-camionero-vehiculo")){

    document.querySelector(".legend").textContent = data.legend_alta_camionero_vehiculo;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-agregar").value = data.btn_agregar;

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

    document.querySelector(".legend-baja-camionero").textContent = data.legend_baja_camionero;
    document.querySelector(".adv").textContent = data.adv_camionero;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camionero;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-cedula").textContent = data.p_cedula;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("modificar-camionero-vehiculo")){

    document.querySelector(".legend-m-relacion").textContent = data.legend_m_camionero_vehiculo;

    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-fecha-inicio").textContent = data.p_fecha_inicio;
    document.querySelector(".p-fecha-fin").textContent = data.p_fecha_fin;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;

  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("id_maneja")){

    document.querySelector(".legend-c-relacion").textContent = data.legend_c_camionero_vehiculo;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-fecha-salida").textContent = data.p_fecha_salida;

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("modificar-camionero")){

    document.querySelector(".legend-m-camionero").textContent = data.legend_m_camionero;
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
  else if(url.includes("Backoffice") && url.includes("op-vehiculos")){

    document.querySelector(".h1-titulo").textContent = data.h1_vehiculos;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector("#h2-1").textContent = data.h1_tabla_camiones;
    document.querySelector("#h2-2").textContent = data.h1_camionetas;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;

  }
  else if(url.includes("Backoffice") && url.includes("op-camiones-baja")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_camiones_baja;
    document.querySelector("#th1-camion").textContent = data.th1_camiones;
    document.querySelector("#th2-camion").textContent = data.th2_camiones;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-camiones")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_camiones;
    document.querySelector("#th1-camion").textContent = data.th1_camiones;
    document.querySelector("#th2-camion").textContent = data.th2_camiones;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;

  }
  else if(url.includes("Backoffice") && url.includes("alta-camiones")){

    document.querySelector(".legend-form").textContent = data.legend_camion;
    document.querySelector(".txt-1").placeholder = data.matricula;
    document.querySelector(".txt-2").placeholder = data.peso_max;
    document.querySelector(".txt-3").placeholder = data.vol_max;

    document.querySelector(".boton-agregar").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("id_camioneta")){

    document.querySelector(".legend-baja").textContent = data.legend_baja_camioneta;
    document.querySelector(".adv").textContent = data.adv_camioneta;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camioneta;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("id_camion_horario") && location.search.includes("fs")){
    document.querySelector(".legend-baja-horario").textContent = data.legend_baja_horario;

    document.querySelector(".adv").textContent = data.adv_horario;
    document.querySelector(".p-datos-de-salida").textContent = data.p_datos_de_salida;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-fecha-salida").textContent = data.p_fecha_salida;

    document.querySelectorAll(".p-almacen-cliente").forEach(almacen => {
      almacen.textContent = data.p_almacen_cliente;
    });
    document.querySelectorAll(".p-fecha-recogida-estimada").forEach(fecha => {
      fecha.textContent = data.p_fecha_recogida_estimada;
    });

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.btn_eliminar;

  }
  else if(url.includes("Backoffice") && url.includes("modificar-horario-entrega")){
    document.querySelector(".legend-m-horario").textContent = data.legend_m_horario_entrega;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_horario;
    document.querySelector(".p-camion").textContent = data.p_camion;
    document.querySelector(".p-sobre-salida").textContent = data.p_sobre_salida;
    
    document.querySelectorAll(".p-almacen").forEach(almacen => {
      almacen.textContent = data.p_almacen;
    });

    
    document.querySelector(".boton-siguiente").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("id_usuario")){
    document.querySelector(".legend-b-usuario").textContent = data.legend_b_usuario;
    document.querySelector(".adv").textContent = data.adv_usuario;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_usuario;
    document.querySelector(".p-usuario").textContent = data.p_usuario;
    document.querySelector(".p-tipo-usuario").textContent = data.p_tipo_usuario;

    document.querySelector(".boton-siguiente").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("modificar-usuario")){
    document.querySelector(".legend-m-usuario").textContent = data.legend_m_usuario;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_usuario;
    document.querySelector(".p-usuario").textContent = data.p_usuario;
    document.querySelector(".p-tipo-usuario").textContent = data.p_tipo_usuario;

    document.querySelector(".boton-siguiente").value = data.boton_modificar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("id_usuario")){
    document.querySelector(".legend-c-usuario").textContent = data.legend_c_usuario;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_usuario;
    document.querySelector(".p-usuario").textContent = data.p_usuario;
    document.querySelector(".p-tipo-usuario").textContent = data.p_tipo_usuario;

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("id_camion_horario")){

    document.querySelector(".legend-c-horario").textContent = data.legend_c_horario_recogida;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_horario;
    document.querySelector(".p-datos-de-salida").textContent = data.p_datos_de_salida;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-fecha-salida").textContent = data.p_fecha_salida;

    document.querySelectorAll(".p-plataforma").forEach(almacen => {
      almacen.textContent = data.p_plataforma;
    });
    document.querySelectorAll(".p-fecha-entrega-estimada").forEach(fecha => {
      fecha.textContent = data.p_fecha_entrega_estimada;
    });

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("id_camion")){

    document.querySelector(".legend-baja-camion").textContent = data.legend_baja_camion;
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
  else if(url.includes("Backoffice") && url.includes("modificar-camiones")){

    document.querySelector(".legend-m-camion").textContent = data.legend_m_camion;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("camion1")){

    document.querySelector(".legend-c-camion").textContent = data.legend_c_camion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camion;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("camion2")){

    document.querySelector(".legend-c-camion").textContent = data.legend_c_camion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camion;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("op-camionetas-baja")){

    document.querySelector(".h1-tabla").textContent = data.h1_camionetas_baja;
    document.querySelector("#th1-camionetas").textContent = data.th1_camionetas;
    document.querySelector("#th2-camionetas").textContent = data.th2_camionetas;
    document.querySelector("#th3-camionetas").textContent = data.th3_camionetas;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-camionetas")){

    document.querySelector(".h1-tabla").textContent = data.h1_camionetas;
    document.querySelector("#th1-camionetas").textContent = data.th1_camionetas;
    document.querySelector("#th2-camionetas").textContent = data.th2_camionetas;
    document.querySelector("#th3-camionetas").textContent = data.th3_camionetas;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;

  }
  else if(url.includes("Backoffice") && url.includes("alta-camioneta")){

    document.querySelector(".legend-form").textContent = data.legend_camioneta;
    document.querySelector(".txt-1").placeholder = data.matricula;
    document.querySelector(".txt-2").placeholder = data.peso_max;
    document.querySelector(".txt-3").placeholder = data.vol_max;

    document.querySelector(".boton-agregar").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("modificar-camioneta")){

    document.querySelector(".legend-m-camioneta").textContent = data.legend_m_camioneta;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-peso-sop").textContent = data.p_peso_sop;
    document.querySelector(".p-volumen-disp").textContent = data.p_volumen_disp;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".txt1").placeholder = data.txt1_camioneta;
    document.querySelector(".txt2").placeholder = data.txt2_camioneta;
    document.querySelector(".txt3").placeholder = data.txt3_camioneta;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("camioneta")){

    document.querySelector(".legend-c-camioneta").textContent = data.legend_c_camioneta;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_camioneta;
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
  else if(url.includes("Backoffice") && url.includes("op-almacen-central-baja")){

    document.querySelector(".h1-tabla").textContent = data.h2_almacen_central_baja;
    document.querySelector("#th1-almacen-central").textContent = data.th1_almacen_central;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-almacen-central")){

    document.querySelector(".h1-tabla").textContent = data.h2_almacen_central;
    document.querySelector("#th1-almacen-central").textContent = data.th1_almacen_central;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;
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
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-numero-almacen").textContent = data.p_numero_almacen;

    document.querySelector(".txt1").placeholder = data.txt1_almacen_central;
    document.querySelector(".txt2").placeholder = data.txt2_almacen_central;

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
  else if(url.includes("Backoffice") && url.includes("op-almacen-cliente-baja")){

    document.querySelector(".h1-tabla").textContent = data.h2_almacen_cliente_baja;
    document.querySelector("#th1-almacen-cliente").textContent = data.th1_almacen_cliente;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-almacen-cliente")){

    document.querySelector(".h1-tabla").textContent = data.h2_almacen_cliente;
    document.querySelector("#th1-almacen-cliente").textContent = data.th1_almacen_cliente;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;
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
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;

    document.querySelector(".txt1").placeholder = data.txt1_almacen_cliente;
    document.querySelector(".txt2").placeholder = data.txt2_almacen_cliente;

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
  else if(url.includes("Backoffice") && url.includes("op-plataforma-baja")){

    document.querySelector(".h1-tabla").textContent = data.h2_plataformas_baja;
    document.querySelector("#th1-plataformas").textContent = data.th1_plataformas;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-plataforma")){

    document.querySelector(".h1-tabla").textContent = data.h2_plataforma;
    document.querySelector("#th1-plataformas").textContent = data.th1_plataformas;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;
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

    document.querySelector(".legend-m-plataforma").textContent = data.legend_m_plataforma;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-telefono").textContent = data.p_telefono;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-departamento").textContent = data.p_departamento;
    document.querySelector(".p-volumen-maximo").textContent = data.p_volumen_maximo;
    
    document.querySelector(".txt1").placeholder = data.txt1_plataforma;
    document.querySelector(".txt2").placeholder = data.txt2_plataforma;
    document.querySelector(".txt3").placeholder = data.txt3_plataforma;
    document.querySelector(".txt4").placeholder = data.txt4_plataforma;

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
  else if(url.includes("Backoffice") && url.includes("op-empresas-cliente-baja")){

    document.querySelector(".h1-tabla").textContent = data.h2_empresas_cliente_baja;
    document.querySelector(".th1-empresa-cliente").textContent = data.th1_empresa_cliente;
    document.querySelector(".th2-empresa-cliente").textContent = data.th2_empresa_cliente;
    document.querySelector(".th3-empresa-cliente").textContent = data.th3_empresa_cliente;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-empresas-cliente")){

    document.querySelector(".h1-tabla").textContent = data.h2_empresas_cliente;
    document.querySelector(".th1-empresa-cliente").textContent = data.th1_empresa_cliente;
    document.querySelector(".th2-empresa-cliente").textContent = data.th2_empresa_cliente;
    document.querySelector(".th3-empresa-cliente").textContent = data.th3_empresa_cliente;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;
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
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-nombre").textContent = data.p_nombre;
    document.querySelector(".p-cedula").textContent = data.p_rut;

    document.querySelector(".txt1").placeholder = data.txt1_empresa_cliente;
    document.querySelector(".txt2").placeholder = data.txt2_empresa_cliente;
    document.querySelector(".txt3").placeholder = data.txt3_empresa_cliente;

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
  else if(url.includes("Backoffice") && url.includes("op-trayecto")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_trayectos;
    document.querySelector(".th1-trayectos").textContent = data.th1_trayectos;
    document.querySelector(".th2-trayectos").textContent = data.th2_trayectos;
    document.querySelector(".th3-trayectos").textContent = data.th3_trayectos;

    document.querySelector(".boton-volver").value = data.btn_volver;

    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("trayecto")){

    document.querySelector(".legend-c-trayecto").textContent = data.legend_c_trayecto;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_trayecto;

    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-destino").textContent = data.p_destino;
    document.querySelector(".p-destinos-intermedios").textContent = data.p_destinos_intermedios;
    document.querySelector(".p-distancia-recorrida").textContent = data.p_distancia_recorrida;
    document.querySelector(".p-duracion-total").textContent = data.p_duracion_total;
    document.querySelector(".p-instrucciones").textContent = data.p_instrucciones;
    

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-gestion-paquete-recogida")){

    document.querySelector(".h1-tabla").textContent = data.h1_tabla_gestion_paquetes;
    document.querySelector(".th1-gestion-paquetes").textContent = data.th1_gestion_paquetes;
    document.querySelector(".th2-gestion-paquetes").textContent = data.th2_gestion_paquetes;

    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("alta-horario-recogida")){

    document.querySelector(".legend-titulo").textContent = data.legend_titulo_alta_recogida;
    document.querySelector(".p-camioneta").textContent = data.p_camioneta;
    document.querySelector(".p-sobre-salida").textContent = data.p_sobre_salida;
    document.querySelector(".p-sobre-recogida").textContent = data.p_sobre_recogida;

    document.querySelector(".boton-siguiente").value = data.btn_agregar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("icth")){

    document.querySelector(".legend-baja-horario").textContent = data.legend_baja_horario;
    document.querySelector(".adv").textContent = data.adv_horario;
    
    document.querySelector(".p-datos-de-salida").textContent = data.p_datos_de_salida;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-fecha-salida").textContent = data.p_fecha_salida;

    document.querySelectorAll(".p-almacen-cliente").forEach(almacen => {
      almacen.textContent = data.p_almacen_cliente;
    });
    document.querySelectorAll(".p-fecha-recogida-estimada").forEach(fecha => {
      fecha.textContent = data.p_fecha_recogida_estimada;
    });


    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Backoffice") && url.includes("modificar-horario-recogida") && location.search.includes("icth")){

    document.querySelector(".legend-m-horario-recogida").textContent = data.legend_m_horario_recogida;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_horario;
    document.querySelector(".p-camioneta").textContent = data.p_camioneta;
    document.querySelector(".p-sobre-salida").textContent = data.p_sobre_salida;
    document.querySelectorAll(".p-almacen").forEach(almacen => {
      almacen.textContent = data.p_almacen;
    });

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("icth")){

    document.querySelector(".legend-c-horario").textContent = data.legend_c_horario_recogida;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_horario;
    document.querySelector(".p-datos-de-salida").textContent = data.p_datos_de_salida;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-fecha-salida").textContent = data.p_fecha_salida;

    document.querySelectorAll(".p-almacen-cliente").forEach(almacen => {
      almacen.textContent = data.p_almacen_cliente;
    });
    document.querySelectorAll(".p-fecha-recogida-estimada").forEach(fecha => {
      fecha.textContent = data.p_fecha_recogida_estimada;
    });

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("detalles-horarios-recogida") && location.search.includes("icth")){

    document.querySelector(".h2-instrucciones").textContent = data.h2_instrucciones;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-gestion-lote-entrega")){

    document.querySelector(".h1-tabla").textContent = data.h1_gestion_lote_entrega;

    document.querySelector(".th1-gestion-lote-entrega").textContent = data.th1_gestion_lote_entrega;
    document.querySelector(".th2-gestion-lote-entrega").textContent = data.th2_gestion_lote_entrega;

    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
  }
  else if(url.includes("Backoffice") && url.includes("alta-horario-entrega")){

    document.querySelector(".legend-alta-horario-entrega").textContent = data.legend_alta_horario_entrega;

    document.querySelector(".p-camion").textContent = data.p_camion;
    document.querySelector(".p-sobre-la-salida").textContent = data.p_sobre_salida;
    document.querySelector(".p-sobre-la-entrega").textContent = data.p_sobre_entrega;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.btn_agregar;

  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("id_camion_horario") && location.search.includes("fs")){
    document.querySelector(".legend-baja-horario").textContent = data.legend_baja_horario;

    document.querySelector(".p-camion").textContent = data.p_camion;
    document.querySelector(".p-sobre-la-salida").textContent = data.p_sobre_salida;
    document.querySelector(".p-sobre-la-entrega").textContent = data.p_sobre_entrega;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.btn_agregar;

  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("id_camion_horario") && location.search.includes("fs")){

    document.querySelector(".legend-c-horario").textContent = data.legend_c_horario_recogida;
    document.querySelector(".adv").textContent = data.adv_horario;
    document.querySelector(".p-datos-de-salida").textContent = data.p_datos_de_salida;
    document.querySelector(".p-matricula").textContent = data.p_matricula;
    document.querySelector(".p-fecha-salida").textContent = data.p_fecha_salida;

    document.querySelectorAll(".p-plataforma").forEach(plataforma => {
      plataforma.textContent = data.p_plataforma;
    });

    document.querySelectorAll(".p-fecha-entrega-estimada").forEach(fecha => {
      fecha.textContent = data.p_fecha_entrega_estimada;
    });

    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Backoffice") && url.includes("op-camionero-vehiculo")){

    document.querySelector(".h1-tabla").textContent = data.h1_camionero_vehiculo;

    document.querySelector(".th1-camionero-vehiculo").textContent = data.th1_camionero_vehiculo;
    document.querySelector(".th2-camionero-vehiculo").textContent = data.th2_camionero_vehiculo;
    document.querySelector(".th3-camionero-vehiculo").textContent = data.th3_camionero_vehiculo;
    document.querySelector(".th4-camionero-vehiculo").textContent = data.th4_camionero_vehiculo;

    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;

  }
  else if(url.includes("Backoffice") && url.includes("baja-dato") && location.search.includes("id_maneja")){

    document.querySelector(".legend-baja-relacion").textContent = data.legend_baja_camionero_vehiculo;
    document.querySelector(".adv").textContent = data.adv_relacion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_relacion;

    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-nombre").textContent = data.p_nombre;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-eliminar").value = data.btn_eliminar;

  }
  else if(url.includes("Backoffice") && url.includes("consultar-dato") && location.search.includes("id_maneja")){

    document.querySelector(".legend-c-relacion").textContent = data.legend_c_camionero_vehiculo;
    document.querySelector(".adv").textContent = data.adv_relacion;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_relacion;

    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-nombre").textContent = data.p_nombre;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-eliminar").value = data.btn_eliminar;

  }
  else if(url.includes("Backoffice") && url.includes("ver-mensajes")){

    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".sin-responder").textContent = data.sin_responder;
    document.querySelector(".en-curso").textContent = data.en_curso;
    document.querySelector(".resuelto").textContent = data.resuelto;

  }
  else if(url.includes("Almacenero") && url.includes("index")){
    
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
    document.querySelector(".p-estado").textContent = data.p_estado;
    document.querySelector(".p-detalles").textContent = data.p_detalles;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Almacenero") && url.includes("modificar-paquete")){

    document.querySelector(".legend-m-paquete").textContent = data.legend_m_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    if(document.querySelector(".p-tipo")){
      document.querySelector(".p-tipo").textContent = data.p_tipo;
    }
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".txt1").placeholder = data.txt1_paquete;
    document.querySelector(".txt2").placeholder = data.txt2_paquete;
    document.querySelector(".txt3").placeholder = data.txt3_paquete;
    document.querySelector(".txt4").placeholder = data.txt4_paquete;

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
  else if(url.includes("Almacenero") && url.includes("op-lotes")){

    document.querySelector(".h1-tabla").textContent = data.h2_lotes;
    document.querySelector(".th1-lotes").textContent = data.th1_lotes;
    document.querySelector(".th2-lotes").textContent = data.th2_lotes;
    document.querySelector(".th3-lotes").textContent = data.th3_lotes;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar;

  }
  else if(url.includes("Almacenero") && url.includes("baja-lote")){

    document.querySelector(".legend-baja-lote").textContent = data.legend_baja_lote;
    document.querySelector(".adv").textContent = data.adv_lote;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Almacenero") && url.includes("modificar-lote")){

    document.querySelector(".legend-m-lote").textContent = data.legend_m_lote;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-cant-paquetes").textContent = data.p_cant_paquetes;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;

    document.querySelector(".txt1").placeholder = data.txt1_lote;
    document.querySelector(".txt2").placeholder = data.txt2_lote;
    document.querySelector(".txt3").placeholder = data.txt3_lote;
    document.querySelector(".txt4").placeholder = data.txt4_lote; 

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Almacenero") && url.includes("consultar-lote")){

    document.querySelector(".legend-c-lote").textContent = data.legend_c_lote;
    document.querySelector(".subtitulo-crud").textContent = data.subtitulo_lote;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-cant-paquetes").textContent = data.p_cant_paquetes;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    document.querySelector(".p-tipo").textContent = data.p_tipo;
    if(document.querySelector(".p-detalles") !== null){
      document.querySelector(".p-detalles").textContent = data.p_detalles;
    }

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Almacenero") && url.includes("asignar-paquetes-lote-menu")){

    document.querySelector(".h1-tabla2").textContent = data.h1_paquetes_lote;
    document.querySelector(".adv").textContent = data.adv_paquetes_lote;

    document.querySelector(".boton-siguiente").textContent = data.boton_siguiente;
    document.querySelector(".boton-volver").textContent = data.btn_volver;
  }
  else if(url.includes("Almacenero") && url.includes("asignar-paquetes-lote-2")){
    document.querySelector(".h1-1").textContent = data.h1_tabla1_paquetes_lote;
    document.querySelector(".h1-2").textContent = data.h1_tabla2_paquetes_lote;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

    document.querySelector(".th1-paquetes-lotes").textContent = data.th1_paquetes_lotes;
    document.querySelector(".th2-paquetes-lotes").textContent = data.th2_paquetes_lotes;
    document.querySelector(".th3-paquetes-lotes").textContent = data.th3_paquetes_lotes;
    document.querySelector(".th1-paquetes-lotes2").textContent = data.th1_paquetes_lotes;
    document.querySelector(".th2-paquetes-lotes2").textContent = data.th2_paquetes_lotes;
    document.querySelector(".th3-paquetes-lotes2").textContent = data.th3_paquetes_lotes;
    
    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar_seleccion;
    document.querySelector(".btn-limpiar2").textContent = data.btn_limpiar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar_seleccion;

  }
  else if(url.includes("Almacenero") && url.includes("asignar-lotes-camion-1")){
    document.querySelector(".h1-tabla2").textContent = data.h1_tabla2_lotes_camion;
    document.querySelector(".adv").textContent = data.adv_lotes_camion;

    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".boton-siguiente").textContent = data.boton_siguiente;

  }
  else if(url.includes("Almacenero") && url.includes("asignar-lotes-camion-2")){
    document.querySelector(".h1-1").textContent = data.h1_tabla_lotes_camion;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

    document.querySelector(".th1-lotes-camion").textContent = data.th1_lotes_camion;
    document.querySelector(".th2-lotes-camion").textContent = data.th2_lotes_camion;
    document.querySelector(".th3-lotes-camion").textContent = data.th3_lotes_camion;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar_seleccion;

    document.querySelector(".h1-2").textContent = data.h1_2_tabla_lotes_camion;

    document.querySelector(".th1-lotes-camion-2").textContent = data.th1_lotes_camion_2;
    document.querySelector(".th2-lotes-camion-2").textContent = data.th2_lotes_camion_2;
    document.querySelector(".th3-lotes-camion-2").textContent = data.th3_lotes_camion_2;

    document.querySelector(".btn-limpiar2").textContent = data.btn_limpiar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar_seleccion;

  }
  else if(url.includes("Camionero") && url.includes("index")){

    document.querySelector("#op1 h2").textContent = data.op1_h2_camionero;
    document.querySelector("#op1 p").textContent = data.op1_p_camionero;
    document.querySelector("#op2 h2").textContent = data.op2_h2_camionero;
    document.querySelector("#op2 p").textContent = data.op2_p_camionero;
    document.querySelector("#op3 h2").textContent = data.op3_h2_camionero;
    document.querySelector("#op3 p").textContent = data.op3_p_camionero;

  }
  else if(url.includes("Camionero") && url.includes("ver-horarios")){

    document.querySelector(".h1-tabla").textContent = data.h1_ver_horarios;
    document.querySelector(".th1-ver-horario").textContent = data.th1_ver_horario;
    document.querySelector(".th2-ver-horario").textContent = data.th2_ver_horario;
    document.querySelector(".th3-ver-horario").textContent = data.th3_ver_horario;
    document.querySelector(".th4-ver-horario").textContent = data.th4_ver_horario;
    document.querySelector(".th5-ver-horario").textContent = data.th5_ver_horario;

  }
  else if(url.includes("Camionero") && url.includes("recoger-paquetes-1")){

    document.querySelector(".h1-tabla2").textContent = data.h1_tabla2_recoger_paquetes;
    document.querySelector(".adv").textContent = data.adv_recoger_paquetes;
    document.querySelector(".boton-siguiente").textContent = data.boton_siguiente;
    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Camionero") && url.includes("recoger-paquetes-2")){

    if(document.querySelector(".h1-1")){
      document.querySelector(".h1-1").textContent = data.h1_tabla_recoger_paquetes;
    }
    if(document.querySelector(".h1-2")){
      document.querySelector(".h1-2").textContent = data.h1_2_tabla_recoger_paquetes;
    }
    if(document.querySelector(".boton-volver")){
      document.querySelector(".boton-volver").textContent = data.btn_volver;
    }

    if(document.querySelector(".th1-recoger-paquetes")){
      document.querySelector(".th1-recoger-paquetes").textContent = data.th1_recoger_paquetes;
    }
    if(document.querySelector(".th2-recoger-paquetes")){
      document.querySelector(".th2-recoger-paquetes").textContent = data.th2_recoger_paquetes;
    }
    if(document.querySelector(".th3-recoger-paquetes")){
      document.querySelector(".th3-recoger-paquetes").textContent = data.th3_recoger_paquetes;
    }

    if(document.querySelector(".btn-limpiar")){
      document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    }
    if(document.querySelector(".boton-agregar")){
      document.querySelector(".boton-agregar").textContent = data.btn_agregar_seleccion;
    }

    if(document.querySelector(".th1-recoger-paquetes-2")){
      document.querySelector(".th1-recoger-paquetes-2").textContent = data.th1_recoger_paquetes;
    }
    if(document.querySelector(".th2-recoger-paquetes-2")){
      document.querySelector(".th2-recoger-paquetes-2").textContent = data.th2_recoger_paquetes;
    }
    if(document.querySelector(".th3-recoger-paquetes-2")){
      document.querySelector(".th3-recoger-paquetes-2").textContent = data.th3_recoger_paquetes;
    }

    if(document.querySelector(".btn-limpiar2")){
      document.querySelector(".btn-limpiar2").textContent = data.btn_limpiar;
    }
    if(document.querySelector(".boton-eliminar")){
      document.querySelector(".boton-eliminar").textContent = data.btn_eliminar_seleccion;
    }

    if(document.querySelector(".alerta-p")){
      document.querySelector(".alerta-p").textContent = data.alerta_no_se_ha_enviado;
      document.querySelector(".boton-siguiente").textContent = data.btn_enviar_solicitud;
    }

    if(document.querySelector(".alerta-p-pendiente")){
      document.querySelector(".alerta-p-pendiente").textContent = data.alerta_p_pendiente;
    }

  }
  else if(url.includes("Camionero") && url.includes("recoger-paquetes-3")){

    document.querySelector(".h1-tabla2").textContent = data.h1_tabla_recoger_paquetes_3;
    document.querySelector(".adv").textContent = data.adv_recoger_paquetes_3;
    document.querySelectorAll(".p1").forEach(p => {
      p.textContent = data.p1_recoger_paquetes_3;
    });
    document.querySelectorAll(".p2").forEach(p => {
      p.textContent = data.p2_recoger_paquetes_3;
    });
    document.querySelectorAll(".btn-recoger-paquetes-3").forEach(btn => {
      console.log(btn);
      btn.textContent = data.btn_recoger_paquetes_3;
    });
    
    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Camionero") && url.includes("entregar-lotes-1")){

    document.querySelector(".h1-tabla2").textContent = data.h1_tabla2_entregar_lotes;
    document.querySelector(".adv").textContent = data.adv_entregar_lotes;
    document.querySelector(".boton-siguiente").textContent = data.boton_siguiente;
    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Camionero") && url.includes("entregar-lotes-2")){

    document.querySelector(".h1-1").textContent = data.h1_tabla_entregar_lotes;
    document.querySelector(".h1-2").textContent = data.h1_2_tabla_entregar_lotes;
    document.querySelector(".boton-volver").textContent = data.btn_volver;

    document.querySelector(".th1-entregar-lotes").textContent = data.th1_entregar_lotes;
    document.querySelector(".th2-entregar-lotes").textContent = data.th2_entregar_lotes;
    document.querySelector(".th3-entregar-lotes").textContent = data.th3_entregar_lotes;

    document.querySelector(".btn-limpiar").textContent = data.btn_limpiar;
    document.querySelector(".boton-agregar").textContent = data.btn_agregar_seleccion;

    document.querySelector(".th1-entregar-lotes-2").textContent = data.th1_entregar_lotes_2;
    document.querySelector(".th2-entregar-lotes-2").textContent = data.th2_entregar_lotes_2;
    document.querySelector(".th3-entregar-lotes-2").textContent = data.th3_entregar_lotes_2;

    document.querySelector(".btn-limpiar2").textContent = data.btn_limpiar;
    document.querySelector(".boton-eliminar").textContent = data.btn_eliminar_seleccion;

  }
  else if(url.includes("Camionero") && url.includes("entregar-lotes-3")){

    document.querySelector(".h1-tabla2").textContent = data.h1_tabla_entregar_lotes_3;
    document.querySelector(".adv").textContent = data.adv_entrega_lotes_3;
    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  if(url.includes("Empresa") && url.includes("index")){
    
    document.querySelector("#op1 h2").textContent = data.op1_h2_empresa;
    document.querySelector("#op1 p").textContent = data.op1_p_empresa;
    document.querySelector("#op2 h2").textContent = data.op2_h2_empresa;
    document.querySelector("#op2 p").textContent = data.op2_p_empresa;
    document.querySelector("#op3 h2").textContent = data.op3_h2_empresa;
    document.querySelector("#op3 p").textContent = data.op3_p_empresa;
    document.querySelector("#op4 h2").textContent = data.op4_h2_empresa;
    document.querySelector("#op4 p").textContent = data.op4_p_empresa;

  }
  if(url.includes("Empresa") && url.includes("op-paquetes-cliente")){
    
    document.querySelector(".h1-tabla").textContent = data.h1_tabla_paq_cliente;
    document.querySelector(".th1-paq-cliente").textContent = data.th1_paq_cliente;
    document.querySelector(".th2-paq-cliente").textContent = data.th2_paq_cliente;
    document.querySelector(".th3-paq-cliente").textContent = data.th3_paq_cliente;

    document.querySelector(".boton-agregar").textContent = data.btn_agregar;
    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  if(url.includes("Empresa") && url.includes("alta-paquete")){
    
    document.querySelector(".legend-titulo").textContent = data.legend_titulo;
    document.querySelector(".p-1").textContent = data.p_1_empresa_paquete;
    document.querySelector(".input-correo").placeholder = data.input_correo;
    document.querySelector(".input-direccion").placeholder = data.input_direccion;
    document.querySelector(".option-departamento").textContent = data.option_departamento;
    document.querySelector(".p-2").textContent = data.p_2_empresa_paquete;
    document.querySelector(".input-peso").placeholder = data.input_peso;
    document.querySelector(".input-volumen").placeholder = data.input_volumen;
    document.querySelector(".option-almacen").textContent = data.option_almacen;
    document.querySelector(".p-3").textContent = data.p_3_empresa_paquete;
    document.querySelector(".radio-si").textContent = data.radio_si;
    document.querySelector(".radio-no").textContent = data.radio_no;
    document.querySelector(".option-fragil").textContent = data.p_3_empresa_paquete;
    document.querySelector(".p-4").textContent = data.p_4_empresa_paquete;
    document.querySelector("textarea").placeholder = data.textarea_empresa_paquete;
    document.querySelector("#btnIngreso").value = data.btn_ingresar_paquete;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  if(url.includes("Empresa") && url.includes("baja-paquete") && location.search.includes("paquete")){
    
    document.querySelector(".legend-baja-paquete").textContent = data.legend_baja_paquete;
    document.querySelector(".adv").textContent = data.adv_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-mail-d").textContent = data.p_mail_d;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    if(document.querySelector(".p-tipo")){
      document.querySelector(".p-tipo").textContent = data.p_tipo;
    }
    document.querySelector(".p-estado").textContent = data.p_estado;
    if(document.querySelector(".p-detalles")){
      document.querySelector(".p-detalles").textContent = data.p_detalles;
    }

    document.querySelector(".boton-eliminar").value = data.btn_eliminar;
    document.querySelector(".boton-volver").value = data.btn_volver;

  }
  else if(url.includes("Empresa") && url.includes("modificar-paquete")){

    document.querySelector(".legend-m-paquete").textContent = data.legend_m_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    document.querySelector(".p-estado").textContent = data.p_estado;

    document.querySelector(".boton-volver").value = data.btn_volver;
    document.querySelector(".boton-siguiente").value = data.boton_modificar;
  }
  else if(url.includes("Empresa") && url.includes("consultar-paquete")){

    document.querySelector(".legend-c-paquete").textContent = data.legend_c_paquete;
    document.querySelector(".p-id").textContent = data.p_id;
    document.querySelector(".p-mail-d").textContent = data.p_mail_d;
    document.querySelector(".p-direccion").textContent = data.p_direccion;
    document.querySelector(".p-peso").textContent = data.p_peso;
    document.querySelector(".p-volumen").textContent = data.p_volumen;
    document.querySelector(".p-fragil").textContent = data.p_fragil;
    if(document.querySelector(".p-fecha-traslado")){
      document.querySelector(".p-fecha-traslado").textContent = data.p_fecha_traslado;
    }
    if(document.querySelector(".p-tipo")){
      document.querySelector(".p-tipo").textContent = data.p_tipo;
    }
    document.querySelector(".p-estado").textContent = data.p_estado;
    console.log(document.querySelector(".p-detalles"));
    if(document.querySelector(".p-detalles")){
      document.querySelector(".p-detalles").textContent = data.p_detalles;
    }

    document.querySelector(".boton-volver").value = data.btn_volver;
  }
  else if(url.includes("Empresa") && url.includes("op-paquetes-transcurso")){
    
    document.querySelector(".h1-tabla").textContent = data.h1_paquetes_transcurso;
    document.querySelector(".th1-paq-transcurso").textContent = data.th1_paquetes_transcurso;
    document.querySelector(".th2-paq-transcurso").textContent = data.th2_paquetes_transcurso;
    document.querySelector(".th3-paq-transcurso").textContent = data.th3_paquetes_transcurso;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Empresa") && url.includes("op-paquetes-entregados")){
    
    document.querySelector(".h1-tabla").textContent = data.h1_paquetes_entregados;
    document.querySelector(".th1-paq-entregados").textContent = data.th1_paquetes_entregados;
    document.querySelector(".th2-paq-entregados").textContent = data.th2_paquetes_entregados;
    document.querySelector(".th3-paq-entregados").textContent = data.th3_paquetes_entregados;

    document.querySelector(".boton-volver").textContent = data.btn_volver;

  }
  else if(url.includes("Empresa") && url.includes("notificaciones")){

    document.querySelector(".boton-volver").textContent = data.btn_volver;
    document.querySelector(".espera").textContent = data.en_espera;
    document.querySelector(".historial").textContent = data.historial;
    document.querySelector(".aceptadas").textContent = data.aceptadas;
    document.querySelector(".denegadas").textContent = data.denegadas;

    document.querySelectorAll(".mensaje-espera").forEach(mensaje => {
      mensaje.textContent = data.mensaje;
    });

    document.querySelectorAll(".boton-siguiente").forEach(btn => {
      btn.textContent = data.btn_aceptar;
    });

    document.querySelectorAll(".boton-denegar2").forEach(btn => {
      btn.textContent = data.btn_denegar;
    });

    document.querySelectorAll(".mensaje-historial").forEach(mensaje => {
      console.log(mensaje.textContent);
      if(mensaje.textContent.includes("aceptada") || mensaje.textContent.includes("acepted")){
        mensaje.textContent = data.mensaje_historial_aceptada;
      }else if(mensaje.textContent.includes("denegada") || mensaje.textContent.includes("denied")){
        mensaje.textContent = data.mensaje_historial_denegada;
      }
    });

  }

}


window.addEventListener("DOMContentLoaded", () => {
  if (!idiomaSeleccionado) {
    // Si no hay idioma seleccionado en localStorage, se carga el idioma por defecto (español)
    cargarTextos("español");
  }
});