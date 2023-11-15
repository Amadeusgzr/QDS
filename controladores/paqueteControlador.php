<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/paqueteModelo.php';
require("funciones.php");
header("Location: ../vistas/permisos.php");



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $paqueteModelo->obtenerPaquetes();

        echo json_encode($respuesta);
        break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_paquete)) {
            $respuesta = $paqueteModelo->obtenerPaquete($_POST->id_paquete);
        } else if (isset($_POST->codigo)) {
            $respuesta = $paqueteModelo->obtenerPaquetePorCodigo($_POST->codigo);
        } else if (isset($_POST->empresa1)) {
            $respuesta = $paqueteModelo->obtenerPaquetePorEmpresa($_POST->empresa1);
        } else if (isset($_POST->id_camioneta)) {
            $respuesta = $paqueteModelo->obtenerPaquetePorCamioneta($_POST->id_camioneta);
        } else if (isset($_POST->id_paquete3)) {
            $respuesta = $paqueteModelo->buscarPorId($_POST->id_paquete3, $_POST->id_almacen_cliente, $_POST->estado);
        } else {
            $numArrays = count($_POST->mail_destinatario);
            $mail_destinatario = $_POST->mail_destinatario;
            for ($i = 0; $i < $numArrays; $i++) {
                if (!filter_var($mail_destinatario[$i], FILTER_VALIDATE_EMAIL)) {
                    $respuesta = [
                        'error' => 'Error',
                        'respuesta' => "La dirección de correo electrónico no es válida $mail_destinatario[$i]"
                    ];
                    break;
                } else {


                    $codigoGenerado = generarCodigo(12);

                    $respuesta = atributosVacio($_POST->mail_destinatario);
                    $respuesta1 = atributosVacio($_POST->direccion);
                    $respuesta2 = atributosVacio($_POST->peso);
                    $respuesta3 = atributosVacio($_POST->volumen);
                    $respuesta4 = atributosVacio($_POST->fragil);
                    $respuesta5 = atributosVacio($_POST->id_almacen_cliente);
                    $respuesta6 = atributosVacio($_POST->id_destino);

                    if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error" && $respuesta5['error'] !== "Error" && $respuesta6['error']) {

                        $respuesta = longitud($_POST->mail_destinatario[$i], 45);
                        $respuesta1 = longitud($_POST->direccion[$i], 45);
                        $respuesta2 = longitud($_POST->peso[$i], 10);
                        $respuesta3 = longitud($_POST->volumen[$i], 10);
                        $respuesta4 = longitud($_POST->fragil[$i], 2);
                        $respuesta5 = longitud($_POST->id_almacen_cliente[$i], 11);
                        $respuesta6 = longitud($_POST->id_destino[$i], 11);

                        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error" && $respuesta5['error'] !== "Error" && $respuesta6['error']) {

                            $respuesta = numeros($_POST->id_destino[$i]);
                            $respuesta1 = numeros($_POST->id_almacen_cliente[$i]);
                            $respuesta2 = numeros($_POST->peso[$i]);
                            $respuesta3 = numeros($_POST->volumen[$i]);

                            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {
                                if (isset($_POST->usuario)) {
                                    $respuesta = $paqueteModelo->guardarPaquete($_POST->mail_destinatario[$i], $_POST->direccion[$i], $_POST->peso[$i], $_POST->volumen[$i], $_POST->fragil[$i], $_POST->tipo[$i], $_POST->detalles[$i], $codigoGenerado, $_POST->id_almacen_cliente[$i], $_POST->id_destino[$i], 'En almacén central');

                                } else {
                                    $respuesta = $paqueteModelo->guardarPaquete($_POST->mail_destinatario[$i], $_POST->direccion[$i], $_POST->peso[$i], $_POST->volumen[$i], $_POST->fragil[$i], $_POST->tipo[$i], $_POST->detalles[$i], $codigoGenerado, $_POST->id_almacen_cliente[$i], $_POST->id_destino[$i], 'En almacén cliente');
                                }

                            } else {
                                $respuesta = [
                                    'error' => "Error",
                                    'respuesta' => "Solo se aceptan números"
                                ];
                            }

                        } else {
                            $respuesta = [
                                'error' => "Error",
                                'respuesta' => "Palabras inválidas"
                            ];
                        }
                    } else {
                        $respuesta = [
                            'error' => 'Error',
                            'respuesta' => 'Hay un atributo que no debe estar vacío'
                        ];
                        break;
                    }
                }
            }
        }

        echo json_encode($respuesta);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));

        if (isset($_PUT->id_paquete1)) {
            $respuesta = atributoVacio($_PUT->id_paquete1);
            if ($respuesta['error'] !== "Error") {
                $respuesta = $paqueteModelo->modificarEstadoPaquete($_PUT->id_paquete1);
            } else {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'El atributo está vacío'
                ];
            }
        } else {
            $respuesta = atributoVacio($_PUT->id_paquete);
            $respuesta1 = atributoVacio($_PUT->direccion);
            $respuesta2 = atributoVacio($_PUT->peso);
            $respuesta3 = atributoVacio($_PUT->volumen);
            $respuesta4 = atributoVacio($_PUT->fragil);
            $respuesta5 = atributoVacio($_PUT->estado);
            $respuesta6 = atributoVacio($_PUT->empresa);
            $respuesta7 = atributoVacio($_PUT->tipo_usu);

            if ($_PUT->tipo_usu !== "empresa") {
                $respuesta5 = atributoVacio($_PUT->estado);
            } else {
                $respuesta5 = [
                    'error' => 'Exito',
                    'respuesta' => 'El atributo está vacío'
                ];
            }


            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error" && $respuesta5['error'] !== "Error" && $respuesta6['error'] !== "Error" && $respuesta7['error'] !== "Error") {
                $respuesta = $paqueteModelo->modificarPaquete($_PUT->id_paquete, $_PUT->direccion, $_PUT->peso, $_PUT->volumen, $_PUT->fragil, $_PUT->estado, $_PUT->empresa, $_PUT->tipo_usu);
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
        if (isset($_DELETE->id_paquete)) {
            $respuesta = atributoVacio($_DELETE->id_paquete);
            $respuesta1 = atributoVacio($_DELETE->empresa);
            $respuesta2 = atributoVacio($_DELETE->tipo_usu);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
                $respuesta = $paqueteModelo->eliminarPaquete($_DELETE->id_paquete, $_DELETE->empresa, $_DELETE->tipo_usu);
            }
        } else {
            $numArrays = count($_DELETE->arrayPaquetes);

            $respuesta = atributoVacio($_DELETE->empresa);
            $respuesta1 = atributoVacio($_DELETE->tipo_usu);
            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error") {

                for ($i = 0; $i < $numArrays; $i++) {
                    $respuesta = $paqueteModelo->eliminarPaquete($_DELETE->arrayPaquetes[$i][0], $_DELETE->empresa, $_DELETE->tipo_usu);
                }
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

function generarCodigo($longitud)
{
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}
?>