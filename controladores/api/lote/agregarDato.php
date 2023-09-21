<?php
$ch = curl_init();

if($_POST){
    $almacen_destino = $_POST["select-almacen-lote"];
    $fecha_traslado = $_POST["fecha_traslado_lote"];
    $hora_traslado = $_POST["hora_traslado_lote"];
    $fragil = $_POST["fragil"];
    $tipo = $_POST["tipo"];
    $detalles = $_POST["detalles-lote"];
    if (isset($_POST["tipo"])){
        $tipo = $_POST["tipo"];
   }else{
       $tipo = null;
   }
   if (isset($_POST["detalles"])){
       $detalles = $_POST["detalles"];
   } else{
       $detalles = null;
   }
}

$array = [
    'almacen_destino' =>  "$almacen_destino",
    'fecha_traslado' => "$fecha_traslado",
    'hora_traslado' => "$hora_traslado",
    'fragil' => "$fragil",
    'tipo' => "$tipo",
    'detalles' => "$detalles",
];

$datos = json_encode($array);

curl_setopt($ch,CURLOPT_URL,'localhost/Diseno-Web/controladores/loteControlador.php');
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)){
    echo curl_errno($ch);
} else{
    $decode = json_decode($respuesta, true);
}


curl_close($ch);
header('Location: ../../../vistas/Almacenero/alta-lote.php?datos=' . urlencode($respuesta));



?>