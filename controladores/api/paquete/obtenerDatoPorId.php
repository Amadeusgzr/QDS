<?php
$ch = curl_init();

$id_paquete = $_GET['id_paquete'];
$array = [
    'id_paquete' => "$id_paquete",
];
$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/Diseno-Web/controladores/paqueteControlador.php');
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
?>