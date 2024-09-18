<?php
$ch = curl_init();

if ($_POST) {
    $id_lote = $_POST["id_lote"];
    $id_plataforma = $_POST["id_plataforma"];
    $id_camion = $_POST["id_camion"];
}

$array = [
    'id_lote' => "$id_lote",
    'id_plataforma' => "$id_plataforma",
    'id_camion' => "$id_camion",
];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/plataformaCamionLoteControlador.php');
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
header('Location: ../../../vistas/Almacenero/asignar-paquetes-lote-2.php?datos=' . urlencode($respuesta) . '&id_lote=' . $id_lote);



?>