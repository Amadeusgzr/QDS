<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/almacenClienteControlador.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)) {
    echo curl_errno($ch);
} else {
    $almacenes_clientes = json_decode($respuesta, true);
}
curl_close($ch);
?>