<?php
$ch = curl_init();
$id_paquete = $_GET["id_paquete"];
$array = [
    'id_paquete' => "$id_paquete",
];

$datos = json_encode($array);

curl_setopt($ch,CURLOPT_URL,'localhost/Diseno-Web/controladores/paqueteControlador.php');
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch,CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)){
    echo curl_errno($ch);
} else{
    $decoded = json_decode($response, true);
}

curl_close($ch);
header('Location: ../../../vistas/Almacenero/baja-paquete.php?data=' . urlencode($response));
?>