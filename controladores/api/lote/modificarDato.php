<?php
$ch = curl_init();

if ($_POST) {
    $id_lote = $_POST["id_lote"];
    $fragil = $_POST["fragil"];
}

$array = [
    'id_lote' => "$id_lote",
    'fragil' => "$fragil",
];

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
header('Location: ../../../vistas/Almacenero/modificar-lote.php?datos=' . urlencode($respuesta) . '&id_lote=' . $id_lote);

?>