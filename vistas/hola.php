<!DOCTYPE html>
<html>

<head>
    <title>Obtener Ruta</title>
</head>

<body>
    <h1>Obtener Ruta</h1>
    <form method="post">
        <label for="start">Ubicación de inicio:</label>
        <input type="text" id="start" name="start" placeholder="Ubicación de inicio" required><br>
        <label for="end">Ubicación de destino:</label>
        <input type="text" id="end" name="end" placeholder="Ubicación de destino" required><br>
        <label for="waypoints">Ubicaciones intermedias:</label><br>
        <input type="text" id="waypoint1" name="waypoints[]" placeholder="Ubicación intermedia 1"><br>
        <input type="text" id="waypoint2" name="waypoints[]" placeholder="Ubicación intermedia 2"><br>
        <button type="submit">Calcular Ruta</button><br>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $waypoints = $_POST['waypoints'];

        $start = str_replace(' ', '', $start);
        $end = str_replace(' ', '', $end);
        $waypoints = str_replace(' ', '', $waypoints);

        $waypointsJson = json_encode($waypoints);


        $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';
        $waypoint_string = implode('|', $waypoints);

// ...

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$start&destination=$end&waypoints=optimize:true|$waypoint_string&key=$api_key&region=uy&language=es";

        $response = file_get_contents($url);

        if ($response) {
            $data = json_decode($response, true);
    
            if ($data['status'] == 'OK') {
                echo '<h2>Instrucciones de giro:</h2>';
                $totalDistance = 0;
                $totalDuration = 0;

                foreach ($data['routes'][0]['legs'] as $leg) {
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
                        
                        $totalDistance += $step['distance']['value'];
                        $totalDuration += $step['duration']['value'];

                    }
                }

                echo '<p>Distancia total: ' . number_format($totalDistance / 1000, 2) . ' km</p>';
                echo '<p>Duración total: ' . round($totalDuration / 60) . ' minutos</p>';

            } else {
                echo 'No se pudo obtener una respuesta de la API de Google Maps Directions.';
            }
        }
    }
    ?>
 


 <div id="map" style="height: 400px; width: 100%;"></div>
 <script>
            const start = "<?php echo $start;?>";
            const end = "<?php echo $end;?>";
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
            // Configura el mapa
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 },
                zoom: 10
            });

            // Crea una instancia de la clase DirectionsService
            var directionsService = new google.maps.DirectionsService();

            // Crea una instancia de la clase DirectionsRenderer
            var directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true
            });

            // Define la solicitud de ruta
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

        // Crea un marcador para el origen
        var originMarker = new google.maps.Marker({
            position: origenCoordenadas,
            map: map,
            title: 'Origen'
        });
    }
});

// Obtén las coordenadas del destino
geocoder.geocode({ 'address': end }, function (results, status) {
    if (status === 'OK') {
        var destinoCoordenadas = results[0].geometry.location;

        // Crea un marcador para el destino
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

                // Crea un marcador para el waypoint
                var waypointMarker = new google.maps.Marker({
                    position: waypointCoordenadas,
                    map: map,
                    title: 'Destino intermedio'
                });

            }
        });
    });  



            // Obtiene la ruta y muestra el resultado en el mapa
            directionsService.route(request, function(response, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(response);
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM&callback=initMap&region=uy&language=es" async defer></script>
</body>


</html>