<?php
session_start();
$ch = curl_init();

if($_GET){
    $id_camion = $_GET["ic"];
    $fecha_salida = $_GET["fs"];
    

    $array = [
        'fecha_salida' => "$fecha_salida",
        'id_camion' => "$id_camion",
    ];
    
    $datos = json_encode($array);
    
    curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/entregarLotesControlador.php');
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
    header('Location: ../../../vistas/Camionero/entregar-lotes-1.php?datos=' . urlencode($respuesta)); 
}
?>