<?php
$ch = curl_init();

$id_almacen_cliente = $_GET["id_almacen_cliente"];
$fecha_recogida_ideal = $_GET["fri"];
$id_camioneta = $_GET["id_camioneta"];
$usuario = $_SESSION["nom_usu"];
$array = [
    'id_camioneta' => "$id_camioneta",
    "fecha_recogida_ideal"=> "$fecha_recogida_ideal",
    "id_almacen_cliente"=> "$id_almacen_cliente",
    "usuario" => "$usuario"
];


$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/solicitudControlador.php');
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