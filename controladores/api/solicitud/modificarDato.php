<?php
session_start();
$ch = curl_init();

if ($_GET) {
    $id_solicitud = $_GET["id_solicitud"];
    $accion = $_GET["a"];
}

$array = [
    'id_solicitud' => "$id_solicitud",
    'accion' => "$accion",

];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/solicitudControlador.php');
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
header('Location: ../../../vistas/Empresa/notificaciones.php?datos=' . urlencode($respuesta));

?>