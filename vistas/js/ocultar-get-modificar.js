    function ocultarDatosEnURL() {
        if (window.history.replaceState) {
            const urlSinDatos = window.location.href.replace(/\?datos=.*&/, '?').replace(/\&datos=.*$/, '');
            window.history.replaceState(null, null, urlSinDatos);
        }
    }

    window.onload = ocultarDatosEnURL;
