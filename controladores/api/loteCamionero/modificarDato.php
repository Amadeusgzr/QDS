<?php
$ch = curl_init();
if($_GET){
$id_lote = $_GET['id_lote'];
$id_camion = $_GET['id_camion'];
$array = [
    'id_lote1' => "$id_lote"
];
}

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/loteControlador.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)) {
    echo curl_errno($ch);
} else {
    $decode = json_decode($respuesta, true);
}
curl_close($ch);
header('Location: ../../../vistas/Camionero/entregar-lotes-2.php?id_camion=' . $id_camion . '&datos=' . urlencode($respuesta));

?>