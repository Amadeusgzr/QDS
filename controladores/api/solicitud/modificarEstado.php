<?php
session_start();
$ch = curl_init();

if($_GET){
    $id_almacen_cliente = $_GET["id_almacen_cliente"];
    $id_camioneta = $_GET["id_camioneta"];
    $fecha_recogida_ideal = $_GET["fri"];
    $usuario = $_SESSION["nom_usu"];
    

    $array = [
        'id_almacen_cliente' => "$id_almacen_cliente",
        'id_camioneta' => "$id_camioneta",
        'fecha_recogida_ideal' => "$fecha_recogida_ideal",
        "usuario1"=> "$usuario",
    ];
    
    $datos = json_encode($array);
    
    curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/solicitudControlador.php');
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
    header('Location: ../../../vistas/Camionero/recoger-paquetes-2.php?id_camioneta=' . $id_camioneta . '&id_almacen_cliente=' . $id_almacen_cliente . '&fri=' . $fecha_recogida_ideal . '&datos=' . urlencode($respuesta)); 
}
?>