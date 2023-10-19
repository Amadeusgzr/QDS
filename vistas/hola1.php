<?php
require("../controladores/api/plataforma/obtenerDato.php");
$destinos = [];
foreach($decode as $plataforma){
    $direccion = $plataforma["direccion"] . ", Departamento de ". $plataforma["departamento"];
    array_push($destinos, $direccion);
}
// Reemplaza 'TU_CLAVE_DE_API' con tu clave de API de Google Maps
$api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';

require("../controladores/api/paquete/obtenerDato.php");
foreach($decode as $paquete){
    echo $paquete["id_paquete"] . "<br>";
    if ($paquete["id_paquete"] == 11){
    $origen = $paquete["direccion"] . ", Departamento de ". $paquete["departamento_destino"];
    }
}

echo $origen;




// Función para obtener las coordenadas geográficas a partir de una dirección
function obtenerCoordenadas($direccion, $api_key) {
    $direccion_codificada = urlencode($direccion);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$direccion_codificada&key=$api_key&region=uy&language=es";
    $response = file_get_contents($url);
    if ($response) {
        $data = json_decode($response, true);
        if ($data['status'] == 'OK') {
            return $data['results'][0]['geometry']['location'];
        }
    }
    return null;
}

// Obtiene las coordenadas del punto de origen
$origen_coordenadas = obtenerCoordenadas($origen, $api_key);

if ($origen_coordenadas) {
    $lat_origen = $origen_coordenadas['lat'];
    $lng_origen = $origen_coordenadas['lng'];

    $distancia_minima = PHP_FLOAT_MAX;
    $destino_mas_cercano = '';

    // Recorre los destinos y encuentra el más cercano
    foreach ($destinos as $destino) {
        $destino_coordenadas = obtenerCoordenadas($destino, $api_key);
        if ($destino_coordenadas) {
            $lat_destino = $destino_coordenadas['lat'];
            $lng_destino = $destino_coordenadas['lng'];
            

            // Calcula la distancia (puede ser la distancia euclidiana)
            $distancia = sqrt(pow($lat_destino - $lat_origen, 2) + pow($lng_destino - $lng_origen, 2));
            echo $distancia . "<br>";
            if ($distancia < $distancia_minima) {
                $distancia_minima = $distancia;
                $destino_mas_cercano = $destino;
            }
        }
    }

    echo "El destino más cercano a '$origen' es '$destino_mas_cercano'.";
} else {
    echo "No se pudo geocodificar la dirección de origen.";
}