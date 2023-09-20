<?php
$ch = curl_init();

if($_POST){
    $id_paquete = $_POST["id_paquete"];
    $direccion = $_POST["direccion"];
    $peso = $_POST["peso"];
    $volumen = $_POST["volumen"];
    $fragil = $_POST["fragil"];
    $estado = $_POST["estado"];
}

$array = [
    'id_paquete' =>  "$id_paquete",
    'direccion' => "$direccion",
    'peso' => "$peso",
    'volumen' => "$volumen",
    'fragil' => "$fragil",
    'estado' => "$estado"
];

$datos = json_encode($array);

curl_setopt($ch,CURLOPT_URL,'localhost/Diseno-Web/controladores/paqueteControlador.php');
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch,CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)){
    echo curl_errno($ch);
} else{
    $decode = json_decode($respuesta, true);
}



curl_close($ch);
header('Location: ../../../vistas/Almacenero/modificar-paquete.php?datos=' . urlencode($respuesta) . '&id_paquete=' . $id_paquete);

?>