    function redirigirSinParametros() {
        if (window.history.replaceState) {
            const urlSinParametros = window.location.href.split('?')[0];
            window.history.replaceState(null, null, urlSinParametros);
        }
    }
    window.onload = redirigirSinParametros;




