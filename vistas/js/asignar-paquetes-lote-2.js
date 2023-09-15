var filas = document.querySelectorAll(".fila-opcion");
var btnLimpiar = document.querySelector(".btn-limpiar");

    // Agregar un evento de clic a cada fila
    filas.forEach(function (fila) {
        fila.addEventListener("click", function () {
            // Toggle (alternar) la clase "fila-seleccionada" en la fila actual
            fila.classList.toggle("fila-seleccionada");
            fila.classList.toggle("fila-opcion");
        });
    });

    btnLimpiar.addEventListener("click", function () {
        filas.forEach(function (fila) {
            if(fila.classList.contains("fila-seleccionada")){
                fila.classList.toggle("fila-seleccionada");
                fila.classList.toggle("fila-opcion");
            }
        });
    });

/***************   OBTENER DATOS DE LA TABLA   ********************/

var botonEnvio = document.getElementById('submit-as-lote-2');
botonEnvio.addEventListener('click', enviarDatos);

function enviarDatos() {
    // Obtener los valores ingresados en los campos de entrada
    var tabla = document.getElementById("tabla-lote");

    for(let i = 0; i < tabla.rows.length; i++){

        var fila = tabla.rows[i];

        // Verifica si la fila está seleccionada y obtiene sus datos
        if(fila.classList.contains("fila-seleccionada")){
            //console.log(fila);
            let contenido = [];
            for(let j = 0; j < fila.cells.length; j++){
                let celda = fila.cells[j];
                contenido[j] = celda.textContent;
            }
            console.log(contenido);
        }
    }

  }