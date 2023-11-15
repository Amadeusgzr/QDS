<?php
session_start();
$ch = curl_init();

if($_GET){
    $id_camioneta = $_GET["ic"];
    $fecha_salida = $_GET["fs"];
    

    $array = [
        'fecha_salida' => "$fecha_salida",
        'id_camioneta' => "$id_camioneta",
    ];
    
    $datos = json_encode($array);
    
    curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/recogerPaquetesControlador.php');
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
    header('Location: ../../../vistas/Camionero/recoger-paquetes-1.php?datos=' . urlencode($respuesta)); 
}
?>