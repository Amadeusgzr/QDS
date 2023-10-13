<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/plataformaCamionLoteModelo.php';

$plataformaCamionLoteModelo = new plataformaCamionLoteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_lote1)) {
            $respuesta = $plataformaCamionLoteModelo->obtenerPlataformaCamionLote($_POST->id_lote1);
        } else{
            $respuesta = atributoVacio($_POST->id_lote);
            $respuesta1 = atributoVacio($_POST->id_plataforma);
            $respuesta2 = atributoVacio($_POST->id_camion);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
                $respuesta = $plataformaCamionLoteModelo->guardarPlataformaCamionLote($_POST->id_lote, $_POST->id_plataforma, $_POST->id_camion);
            } else {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'Hay un atributo que no debe estar vacío',
                ];

            }
        }


        echo json_encode($respuesta);
        break;
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