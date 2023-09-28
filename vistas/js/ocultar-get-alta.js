 // Función para redirigir sin parámetros
    function redirigirSinParametros() {
        if (window.history.replaceState) {
            const urlSinParametros = window.location.href.split('?')[0];
            window.history.replaceState(null, null, urlSinParametros);
        }
    }
    // Llama a la función al cargar la página
    window.onload = redirigirSinParametros;




