<?php
$ch = curl_init();
if (isset($_GET["id_paquete"])) {
    $id_paquete = $_GET["id_paquete"];
    $array = [
        'id_paquete' => "$id_paquete",
    ];

}
if (isset($_POST['todo'])) {
    $jsonString = $_POST['todo'];
    $array = json_decode($jsonString, true);
}



$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/paqueteControlador.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)) {
    echo curl_errno($ch);
} else {
    $decode = json_decode($respuesta, true);
}

curl_close($ch);
if (isset($_GET["id_paquete"])) {
    header('Location: ../../../vistas/Almacenero/op-paquetes.php?datos=' . urlencode($respuesta));
} else {
    $respuesta = urlencode($respuesta);
    echo $respuesta;
}
?>