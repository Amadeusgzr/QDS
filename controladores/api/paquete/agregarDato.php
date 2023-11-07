<?php
session_start();
$ch = curl_init();

if ($_POST) {
    $mail_destinatario = $_POST["mail_destinatario"];
    $direccion = $_POST["direccion"];
    $peso = $_POST["peso"];
    $volumen = $_POST["volumen"];
    $fragil = $_POST["fragil"];
    $id_destino = $_POST["id_destino"];
    $id_almacen_cliente = $_POST["id_almacen_cliente"];
    if (isset($_POST["tipo"])) {
        $tipo = $_POST["tipo"];
    } else {
        $tipo = null;
    }
    if (isset($_POST["detalles"])) {
        $detalles = $_POST["detalles"];
    } else {
        $detalles = null;
    }
    $usuario = $_SESSION["tipo_usu"];
}

$array = [
    'mail_destinatario' => $mail_destinatario,
    'direccion' => $direccion,
    'peso' => $peso,
    'volumen' => $volumen,
    'fragil' => $fragil,
    'tipo' => $tipo,
    'detalles' => $detalles,
    'id_destino' => $id_destino,
    'id_almacen_cliente' => $id_almacen_cliente,
    'usuario' => $usuario
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

echo $respuesta;


curl_close($ch);
header('Location: ../../../vistas/Almacenero/alta-paquete.php?datos=' . urlencode($respuesta));




?>