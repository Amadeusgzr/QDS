<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<?php
include("../../modelos/db.php");
if (isset($_GET['id_camionero'])) {
    $id_camionero = $_GET['id_camionero'];

    $instruccion = "select * from camionero where id_camionero=$id_camionero";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $cedula = $fila["cedula"];
        $nombre_completo = $fila["nombre_completo"];
        $telefono = $fila["telefono"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend class='legend-c-camionero'>Consultar Camionero</legend>
        <p class='subtitulo-crud'>Datos del camionero</p>
        <p><b class='p-id'>ID: </b>$id_camionero</p>
        <p><b class='p-cedula'>Cédula: </b>$cedula</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_completo</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-camioneros.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_almacen_cliente'])) {
    $id_almacen_cliente = $_GET['id_almacen_cliente'];


    $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];

        echo "<div class='form-crud'>
        <legend class='legend-c-almacen-cliente'>Consultar Almacen Cliente</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b class='p-id'>ID: </b>$id_almacen_cliente</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-direccion'>Dirección: </b>$direccion</p>
        <a href='op-almacen-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

} else if (isset($_GET['id_almacen_central'])) {
    $id_almacen_central = $_GET['id_almacen_central'];


    $instruccion = "select * from almacen_central where id_almacen_central=$id_almacen_central";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_central = $fila["id_almacen_central"];
        $telefono = $fila["telefono"];
        $numero_almacen = $fila["numero_almacen"];

        echo "<div class='form-crud'>
        <legend class='legend-c-almacen-central'>Consultar Almacen Central</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b class='p-id'>ID: </b>$id_almacen_central</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-numero-almacen'>Número de almacén: </b>$numero_almacen</p>
        <a href='op-almacen-central.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

} else if (isset($_GET['id_plataforma'])) {
    $id_plataforma = $_GET['id_plataforma'];


    $instruccion = "select * from plataforma where id_plataforma=$id_plataforma";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_plataforma = $fila["id_plataforma"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];
        $departamento = $fila["departamento"];
        $volumen = $fila["volumen_maximo"];

        $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';
        $origen = 'FelipeSanguinetti2474';
        $destino = str_replace(' ', '', $direccion) . ",Departamentode" . $departamento;
        // Construir la URL para la solicitud a la API
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$destino&key=$api_key&region=uy&language=es";

        $response = file_get_contents($url);

        $data = json_decode($response);

        // Realizar la solicitud a la API
        $response = file_get_contents($url);
        echo "<div class='form-crud'>
        <legend class='legend-c-plataforma'>Consultar Plataforma</legend>
        <p class='subtitulo-crud'>Datos de la plataforma</p>
        <p><b class='p-id'>ID: </b>$id_plataforma</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-direccion'>Dirección: </b>$direccion</p>
        <p><b class='p-departamento'>Departamento: </b>$departamento</p>
        <p><b class='p-volumen-maximo'>Volumen máx.: </b>$volumen</p>
        <p><b class='p-trayecto'>Trayecto: </b></p>";
        if ($data->status === "OK") {
            // Recuperar las direcciones en texto
            $pasos = $data->routes[0]->legs[0]->steps;
            $direccionesTexto = [];

            $data = json_decode($response);

            foreach ($pasos as $paso) {
                $direccionesTexto[] = $paso->html_instructions;
            }

            // Imprimir las direcciones en texto
            foreach ($direccionesTexto as $direcciones) {
                echo "<p>$direcciones</p>";
            }
        }
        echo "<a href='op-plataforma.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

} else if (isset($_GET['id_camion1'])) {
    $id_camion = $_GET['id_camion1'];


    $instruccion = "select * from camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion where id_camion=$id_camion";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_camion = $fila["id_camion"];
        $matricula = $fila["matricula"];
        $peso_soportado = $fila["peso_soportado"];
        $volumen_disponible = $fila["volumen_disponible"];
        $estado = $fila["estado"];

        echo "<div class='form-crud'>
        <legend class='legend-c-camion'>Consultar Camión</legend>
        <p class='subtitulo-crud'>Datos del camión</p>
        <p><b class='p-id'>ID: </b>$id_camion</p>
        <p><b class='p-matricula'>Matrícula: </b>$matricula</p>
        <p><b class='p-peso-sop'>Peso soportado: </b>$peso_soportado Kg</p>
        <p><b class='p-volumen-disp'>Volumen disponible: </b>$volumen_disponible Cm3</p>
        <p><b class='p-estado'>Estado: </b>$estado</p>
        <a href='op-camiones.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
}
    else if (isset($_GET['id_camioneta'])) {
        $id_camioneta = $_GET['id_camioneta'];
    
    
        $instruccion = "select * from camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where id_camioneta=$id_camioneta";
        $filas = $conexion->query($instruccion);
    
        foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
            $id_camioneta = $fila["id_camioneta"];
            $matricula = $fila["matricula"];
            $peso_soportado = $fila["peso_soportado"];
            $volumen_disponible = $fila["volumen_disponible"];
            $estado = $fila["estado"];
    
            echo "<div class='form-crud'>
            <legend class='legend-c-camioneta'>Consultar Camioneta</legend>
            <p class='subtitulo-crud'>Datos de la camioneta</p>
            <p><b class='p-id'>ID: </b>$id_camioneta</p>
            <p><b class='p-matricula'>Matrícula: </b>$matricula</p>
            <p><b class='p-peso-sop'>Peso soportado: </b>$peso_soportado Kg</p>
            <p><b class='p-volumen-disp'>Volumen disponible: </b>$volumen_disponible Cm3</p>
            <p><b class='p-estado'>Estado: </b>$estado</p>
            <a href='op-camionetas.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
            </div>";
        }
} else if (isset($_GET['id_empresa_cliente'])) {
    $id_empresa_cliente = $_GET['id_empresa_cliente'];


    $instruccion = "select * from empresa_cliente where id_empresa_cliente=$id_empresa_cliente";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_empresa = $fila["id_empresa_cliente"];
        $rut = $fila["rut"];
        $nombre_de_empresa = $fila["nombre_de_empresa"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend class='legend-c-empresa-cliente'>Consultar Empresa Cliente</legend>
        <p class='subtitulo-crud'>Datos de la empresa</p>
        <p><b class='p-id'>ID: </b>$id_empresa</p>
        <p><b class='p-cedula'>RUT: </b>$rut</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_de_empresa</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-empresas-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

} else if (isset($_GET['nom_usu'])) {
    $nom_usu = $_GET['nom_usu'];

    $instruccion = "select * from login where nom_usu='$nom_usu'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $nom_usu = $fila["nom_usu"];
        $tipo_usu = $fila["tipo_usu"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend>Consultar Usuario</legend>
        <p class='subtitulo-crud'>Datos del usuario</p>
        <p><b>Usuario: </b>$nom_usu</p>
        <p><b>Tipo de Usuario: </b>$tipo_usu</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-usuarios.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    } 
} else if (isset($_GET['id_trayecto'])) {
    $id_trayecto = $_GET['id_trayecto'];

    $instruccion = "select * from trayecto where id_trayecto=$id_trayecto";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_trayecto = $fila["id_trayecto"];
        $origen = "Felipe Sanguinetti 2474";
        $destino = $fila["destino"];
        $destinos_intermedios = $fila["destinos_intermedios"];
        $distancia_recorrida = $fila["distancia_recorrida"];
        $duracion_total = $fila["duracion_total"];



        echo "<div class='form-crud'>
        <legend class='legend-c-trayecto'>Consultar Trayecto</legend>
        <p class='subtitulo-crud'>Datos de la ruta</p>
        <p><b class='p-id'>ID: </b>$id_trayecto</p>
        <p><b class='p-destino'>Destino: </b>$destino</p>
        <p><b class='p-destinos-intermedios'>Destinos Intermedios: </b>$destinos_intermedios</p>
        <p><b class='p-distancia-recorrida'>Distancia Recorrida: </b>$distancia_recorrida Km</p>
        <p><b class='p-duracion-total'>Duración Total: </b>$duracion_total minutos</p>
        <p><b class='p-instrucciones'>Instrucciones: </b></p>";

        $origen1 = str_replace(' ', '', $origen);
        $destino1 = str_replace(' ', '', $destino);
        $intermedios2 = str_replace(' ', '', $destinos_intermedios);
        $intermediosArray = explode('|', $intermedios2);

        $waypointsJson = json_encode($intermediosArray);

        $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen1&destination=$destino1&waypoints=optimize:true|$intermedios2&key=$api_key&region=uy&language=es";


        $response = file_get_contents($url);

        if ($response) {
            $datos = json_decode($response, true);
    
            if ($datos['status'] == 'OK') {
                $distanciaTotal = 0;
                $duracionTotal = 0;

                foreach ($datos['routes'][0]['legs'] as $leg) {
                    foreach ($leg['steps'] as $step) {

                        echo '<p>' . $step['html_instructions'] . '</p>';
                        echo '<p>Distancia hasta el próximo giro: ' . $step['distance']['text'] . '</p>';

                        if (isset($step['traffic_speed_entry'])) {
                            foreach ($step['traffic_speed_entry'] as $trafficData) {
                                echo '<p>Segmento de tráfico: ' . $trafficData['segment'] . '</p>';
                                echo '<p>Velocidad de tráfico: ' . $trafficData['speed'] . '</p>';
                                echo '<hr>';
                            }
                        }
                        echo '<hr>';

                        $distanciaTotal += $step['distance']['value'];
                        $duracionTotal += $step['duration']['value'];
                    }
                }
                $distanciaTotal = number_format($distanciaTotal / 1000 , 2);
                $duracionTotal = round($duracionTotal / 60);
                
            } else {
                echo 'No se pudo obtener una respuesta de la API de Google Maps Directions.';
            }
        }
    }
    ?>
    <p><b>Mapa: </b></p>
    <div id="map" style="height: 400px; width: 100%;"></div>
 
    <script>
        const start = "<?php echo $origen1;?>";
        const end = "<?php echo $destino1;?>";
        const waypointInputs = <?php echo $waypointsJson;?>;

        console.log(start);
        console.log(end);
        console.log(waypointInputs);

        waypoints = [];

        waypointInputs.forEach(function(input) {
            if (input) {
                waypoints.push({
                    location: input,
                    stopover: true
                });
            }
        });

        console.log(waypoints);

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 },
                zoom: 10
            });

            var directionsService = new google.maps.DirectionsService();

            var directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true
            });

            var request = {
                origin: start,
                destination: end,
                waypoints: waypoints,
                travelMode: 'DRIVING',
                optimizeWaypoints: true
            };

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'address': start }, function (results, status) {
                if (status === 'OK') {
                    var origenCoordenadas = results[0].geometry.location;

                    var originMarker = new google.maps.Marker({
                        position: origenCoordenadas,
                        map: map,
                        title: 'Origen'
                    });
                }
            });

            geocoder.geocode({ 'address': end }, function (results, status) {
                if (status === 'OK') {
                    var destinoCoordenadas = results[0].geometry.location;

                    var destinationMarker = new google.maps.Marker({
                        position: destinoCoordenadas,
                        map: map,
                        title: 'Destino'
                    });
                }
            });

            waypointInputs.forEach(function (waypoint) {
                geocoder.geocode({ 'address': waypoint }, function (results, status) {
                    if (status === 'OK') {
                        var waypointCoordenadas = results[0].geometry.location;

                        var waypointMarker = new google.maps.Marker({
                            position: waypointCoordenadas,
                            map: map,
                            title: 'Destino intermedio'
                        });
                    }
                });
            });  

            directionsService.route(request, function(response, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(response);
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM&callback=initMap&region=uy&language=es" async defer></script>
    <a href='op-trayecto.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>
    <?php
} else if (isset($_GET['id_camioneta_horario'])) {
    $id_camioneta = $_GET['id_camioneta_horario'];
    $fecha_salida = $_GET["fs"];
    $hora_salida = $_GET["hs"];
    $almacen_central_salida = $_GET["acs"];

    $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida' AND hora_salida='$hora_salida'";
    $filas = $conexion->query($instruccion);
    $filas = $filas->fetch_all(MYSQLI_ASSOC);

    if (count($filas) > 0){
        foreach ($filas as $fila) {
            $matricula = $fila["matricula"];
            $fecha_salida = $fila["fecha_salida"];
            $hora_salida = $fila["hora_salida"];
        } 
    }
    echo "
    <div class='form-crud'>
    <legend>Eliminar Horario</legend>
    <p class='adv'>¿Seguro que quiere eliminar el siguiente horario? Los cambios serán irreversibles</p>
    <p>Datos de salida</p>
    <p><b>Matricula: </b>$matricula</p>
    <p><b>Fecha salida: </b>$fecha_salida</p>
    <p><b>Hora salida: </b>$hora_salida</p>";

    $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta inner join almacen_cliente on recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join tiene on tiene.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida' AND hora_salida='$hora_salida' ORDER BY fecha_recogida_ideal ASC, hora_recogida_ideal ASC;";
    $filas = $conexion->query($instruccion);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        echo "<hr>";
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $fecha_recogida_ideal = $fila["fecha_recogida_ideal"];
        $hora_recogida_ideal = $fila["hora_recogida_ideal"];
        $direccion_almacen = $fila["direccion"];
        $empresa = $fila["nombre_de_empresa"];

        
        echo "
        <p><b>Almacen cliente: </b>$direccion_almacen - $empresa</p>
        <p><b>Fecha recogida estimado: </b>$fecha_recogida_ideal</p>
        <p><b>Hora recogida estimado: </b>$hora_recogida_ideal</p>";
    }

    echo "<a href='op-gestion-paquete-recogida.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>";
}
?>   
        