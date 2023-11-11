    $(document).ready(function() {
            function cargarSolicitudes(estado) {
                $.ajax({
                    url: "../../controladores/api/solicitud/obtenerDatos.php",
                    type: "POST",
                    data: { estado: estado },
                    success: function(data) {
                        $("#contenido").html(data);
                    }
                });
            }
    
            $(".seccion-btn").click(function() {
                $(".seccion-btn").removeClass("active");
    
                $(this).addClass("active");
    
                var estado = this.id;
                cargarSolicitudes(estado);
            });
    
            var intervalo = 10000; 

            
            function actualizarSolicitudesPeriodicamente() {
                var seccionActual = $(".seccion-btn.active").attr("id");
                cargarSolicitudes(seccionActual);
            }
    
            actualizarSolicitudesPeriodicamente();
    
            setInterval(actualizarSolicitudesPeriodicamente, intervalo);
        });