<?php
$ch = curl_init();
if ($_GET) {
    $id_lote = $_GET["id_lote"];
    $id_paquete = $_GET["id_paquete"];
}

$array = [
    'id_lote' => "$id_lote",
    'id_paquete' => "$id_paquete"
];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/paqueteLoteControlador.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)) {
    echo curl_errno($ch);
} else {
    $decode = json_decode($respuesta, true);
}

curl_close($ch);
header('Location: ../../../vistas/Almacenero/asignar-paquetes-lote-2.php?datos=' . urlencode($respuesta) . '&id_lote=' . $id_lote);

?>