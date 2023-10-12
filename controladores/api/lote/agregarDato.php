<?php
$ch = curl_init();

if ($_POST) {
    $fecha_ideal_traslado = $_POST["fecha_ideal_traslado"];
    $hora_ideal_traslado = $_POST["hora_ideal_traslado"];
    $fragil = $_POST["fragil"];
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
}

$array = [
    'fecha_ideal_traslado' => $fecha_ideal_traslado,
    'hora_ideal_traslado' => $hora_ideal_traslado,
    'fragil' => $fragil,
    'tipo' => $tipo,
    'detalles' => $detalles,
];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/loteControlador.php');
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
if ($decode['error'] == 'Error') {
    header('Location: ../../../vistas/Almacenero/alta-lote.php?datos=' . urlencode($respuesta));

} else {
    $id_lote = $decode['id_lote'];
    header('Location: ../../../vistas/Almacenero/asignar-paquetes-lote-2.php?datos=' . urlencode($respuesta) . '&id_lote=' . $id_lote);

}



?>