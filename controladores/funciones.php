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

function longitud($palabra, $max_longitud)
{
    $longitud = strlen($palabra);

    if ($longitud <= $max_longitud) {
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Palabra válida"
        ];
    } else {
        $respuesta = [
            'error' => "Error",
            'respuesta' => "Palabra inválida"
        ];
    }
    return $respuesta;
}

function numeros($atributo)
{
    if (ctype_digit($atributo)) {
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Palabra válida"
        ];
    } else {
        $respuesta = [
            'error' => "Error",
            'respuesta' => "Palabra inválida"
        ];
    }
    return $respuesta;
}

function letras($atributo)
{

    if (preg_match('/^[A-Za-z\sáéíóúüÁÉÍÓÚÜñÑ]+$/', $atributo)) {
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Palabra válida"
        ];
    } else {
        $respuesta = [
            'error' => "Error",
            'respuesta' => "Palabra inválida"
        ];
    }
    return $respuesta;
}
?>