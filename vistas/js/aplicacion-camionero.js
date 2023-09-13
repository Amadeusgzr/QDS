var filas = document.querySelectorAll(".fila-opcion");

    // Agregar un evento de clic a cada fila
    filas.forEach(function (fila) {
        fila.addEventListener("click", function () {
            // Toggle (alternar) la clase "fila-seleccionada" en la fila actual
            fila.classList.toggle("fila-seleccionada");
            fila.classList.toggle("fila-opcion");
        });
    });