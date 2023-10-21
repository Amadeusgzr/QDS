<?php
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

function existencia($tabla, $columna, $atributo)
{
    include("../../modelos/db.php");
    $instruccion = "select * from $tabla where $columna='$atributo'";
    $resultado = $conexion->query($instruccion);
    $numFilas = $resultado->num_rows;
    if ($numFilas > 0) {
        $respuesta = [
            'error' => "Error",
            'respuesta' => "Ya existe el atributo $atributo"
        ];
    } else {
        $respuesta = [
            'error' => "Exito",
            'respuesta' => "No existe el atributo $atributo"
        ];
    }
    return $respuesta;
}

function verificarLongitud($atributos, $cantCaracteres){

    foreach ($atributos as $atributo) {
        $respuesta = [
            'error' => "Exito",
            'respuesta' => "Exito"
        ];
        if (strlen($atributo) > $cantCaracteres){
            $respuesta = [
                'error' => "Error",
                'respuesta' => "El atributo tiene que ser menor a " . $cantCaracteres . " caracteres"
            ];
        } else {
            $respuesta = [
                'error' => "Exito",
                'respuesta' => "Exito"
            ];
        }
    }

    return $respuesta;

}

?>