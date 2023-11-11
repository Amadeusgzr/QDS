<?php
session_start();
$ch = curl_init();

if($_GET){
    $id_almacen_cliente = $_GET["id_almacen_cliente"];
    $id_camioneta = $_GET["id_camioneta"];
    $fecha_recogida_ideal = $_GET["fri"];
    $hora_recogida_ideal = $_GET["hri"];
    $usuario = $_SESSION["nom_usu"];
    

    $array = [
        'id_almacen_cliente' => "$id_almacen_cliente",
        'id_camioneta' => "$id_camioneta",
        'fecha_recogida_ideal' => "$fecha_recogida_ideal",
        "hora_recogida_ideal"=> "$hora_recogida_ideal",
        "usuario1"=> "$usuario",
    ];
    
    $datos = json_encode($array);
    
    curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/solicitudControlador.php');
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
    header('Location: ../../../vistas/Camionero/recoger-paquetes-2.php?id_camioneta=' . $id_camioneta . '&id_almacen_cliente=' . $id_almacen_cliente . '&fri=' . $fecha_recogida_ideal . '&hri=' . $hora_recogida_ideal . '&datos=' . urlencode($respuesta)); 
}
?>