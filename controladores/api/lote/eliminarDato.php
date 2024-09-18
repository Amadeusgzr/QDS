<?php
$ch = curl_init();
$id_lote = $_GET["id_lote"];
$array = [
    'id_lote' => "$id_lote",
];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/loteControlador.php');
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
header('Location: ../../../vistas/Almacenero/op-lotes.php?datos=' . urlencode($respuesta));
?>