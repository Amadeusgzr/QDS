<?php
$ch = curl_init();

if ($_POST) {
    $nombre_remitente = $_POST["nombre_remitente"];
    $mail_remitente = $_POST["mail_remitente"];
    $mensaje = $_POST["mensaje"];
    date_default_timezone_set('America/Montevideo');
    $fecha_mensaje = date("Y-m-d H:i:s");

}

$array = [
    "nombre_remitente"=> "$nombre_remitente",
    "mail_remitente"=> "$mail_remitente",
    "mensaje"=> "$mensaje",
    "fecha_mensaje"=> "$fecha_mensaje"
];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/mensajeControlador.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)) {
    echo curl_errno($ch);
} else {
    $decode = json_decode($respuesta, true);
}


curl_close($ch);
header('Location: ../../../index.php?datos=' . urlencode($respuesta));




?>