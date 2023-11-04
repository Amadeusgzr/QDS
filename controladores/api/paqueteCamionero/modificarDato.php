<?php
$ch = curl_init();
if($_GET){
if (isset($_GET["id_paquete"])) {
$id_paquete = $_GET['id_paquete'];
$array = [
    'id_paquete1' => "$id_paquete"
];
}
} else {
    $array = [
        'id_paquete1' => ""
    ];
}
$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/paqueteControlador.php');
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
header('Location: ../../../vistas/Camionero/recoger-paquetes-2.php?datos=' . urlencode($respuesta));

?>