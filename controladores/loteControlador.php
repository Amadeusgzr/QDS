<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/loteModelo.php';

$loteModelo = new loteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));
        $respuesta = $loteModelo->obtenerLotes();
        echo json_encode($respuesta);
        break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_lote)) {
            $respuesta = $loteModelo->obtenerLote($_POST->id_lote);
        } else {
            $numArrays = count($_POST->fragil);

            for ($i = 0; $i < $numArrays; $i++) {
                $respuesta1 = atributosVacio($_POST->fragil);
                $respuesta2 = atributosVacio($_POST->id_almacen_central);
                $respuesta3 = atributosVacio($_POST->id_destino);
                if ($respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {
                    $respuesta = $loteModelo->guardarLote($_POST->fragil[$i], $_POST->tipo[$i], $_POST->detalles[$i], $_POST->id_almacen_central[$i], $_POST->id_destino[$i]);
                } else {
                    $respuesta = [
                        'error' => 'Error',
                        'respuesta' => 'Hay un atributo que no debe estar vacío'
                    ];
                }
            }
        }
        echo json_encode($respuesta);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        if (isset($_PUT->id_lote1)) {
            $respuesta = atributoVacio($_PUT->id_lote1);
            if ($respuesta['error'] !== "Error"){
                $respuesta = $loteModelo->modificarEstadoLote($_PUT->id_lote1);
            } else{
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'El atributo está vacío'
                ];
            }      
        } else{
            $respuesta = atributoVacio($_PUT->id_lote);
            $respuesta4 = atributoVacio($_PUT->fragil);

            if ($respuesta['error'] !== "Error" && $respuesta4['error'] !== "Error") {
                $respuesta = $loteModelo->modificarLote($_PUT->id_lote, $_PUT->fragil);
            } else {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'Hay un atributo que no debe estar vacío'
                ];
            }
        }
        echo json_encode($respuesta);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_DELETE->id_lote);
        if ($respuesta['error'] !== "Error") {
            $respuesta = $loteModelo->eliminarLote($_DELETE->id_lote);
        }
        echo json_encode($respuesta);
        break;
}
function atributosVacio($atributos)
{
    $numArrays = count($atributos);
    for ($i = 0; $i < $numArrays; $i++) {
        foreach ($atributos as $atributo) {
            if (!isset($atributo) || is_null($atributo) || empty(trim($atributo))) {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'Hay un atributo que no debe estar vacío'
                ];
                break;
            } else {
                $respuesta = [
                    'error' => 'Exito',
                    'respuesta' => 'Todos los atributos están correctos'
                ];
            }
        }
    }
    return $respuesta;
}
function atributoVacio($atributo)
{
    if (!isset($atributo) || is_null($atributo) || empty(trim($atributo))) {
        $respuesta = [
            'error' => 'Error',
            'respuesta' => 'Hay un atributo que no debe estar vacío'
        ];
    } else {
        $respuesta = [
            'error' => 'Exito',
            'respuesta' => 'Todos los atributos están correctos'
        ];
    }
    return $respuesta;
}

?>