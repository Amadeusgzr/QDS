<?php
session_start();
$ch = curl_init();

if ($_POST) {
    $contrasenia_actual = $_POST["contrasenia_actual"];
    $contrasenia_cambiar = $_POST["contrasenia_cambiar"];
    $contrasenia_repetir = $_POST["contrasenia_repetir"];
    $usuario = $_SESSION["nom_usu"];

}

$array = [
    'contrasenia_actual' => "$contrasenia_actual",
    'contrasenia_cambiar' => "$contrasenia_cambiar",
    'contrasenia_repetir' => "$contrasenia_repetir",
    'usuario' => "$usuario"
];

$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/datavision/controladores/contraseniaControlador.php');
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
if ($decode['error'] == 'Error'){
    header('Location: ../../../vistas/cambiar-contrasenia.php?datos=' . urlencode($respuesta));
} else {
    session_destroy();
    header('Location: ../../../vistas/login.php?datos=' . urlencode($respuesta));
}

?>