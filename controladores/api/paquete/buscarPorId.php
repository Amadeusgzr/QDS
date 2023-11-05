<?php
$ch = curl_init();

if ($_POST){
$id_paquete = $_POST['id_paquete'];
$id_almacen_cliente = $_POST['id_almacen_cliente'];
$estado = $_POST['estado'];

$array = [
    'id_paquete3' => "$id_paquete",
    "id_almacen_cliente"=> "$id_almacen_cliente",
    "estado"=> "$estado"        
];
$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/paqueteControlador.php');
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
}
?>