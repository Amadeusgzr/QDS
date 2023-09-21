// Obtener los parámetros GET actuales
var parametrosGET = new URLSearchParams(window.location.search);

// Itera a través de todos los parámetros y los elimina uno por uno
parametrosGET.forEach(function(valor, clave) {
    parametrosGET.delete(clave);
});

// Crea una nueva URL sin los parámetros GET
var nuevaURL = window.location.pathname;

// Modifica la URL en la barra de direcciones sin recargar la página
history.pushState({}, '', nuevaURL);



