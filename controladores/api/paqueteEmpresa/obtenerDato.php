<?php
$ch = curl_init();

$empresa = $_SESSION['nom_usu'];
$array = [
    'empresa1' => "$empresa",
];
$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/paqueteControlador.php');
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