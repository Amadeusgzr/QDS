<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
require ("../../controladores/funciones.php");
include("../../modelos/db.php");
if (isset($_POST["id_almacen_central"])) {
    $id_almacen_central = $_POST["id_almacen_central"];
    $telefono = $_POST["telefono"];
    $numero_almacen = $_POST["numero_almacen"];

    $instruccion = "update almacen_central set numero_almacen='$numero_almacen', telefono='$telefono' where id_almacen_central=$id_almacen_central";
    $conexion->query($instruccion);
    header("Location: modificar-almacen-central.php?id_almacen_central=$id_almacen_central");
} else if (isset($_POST["id_almacen_cliente"])) {
    $id_almacen_cliente = $_POST["id_almacen_cliente"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    $instruccion = "update almacen_cliente set direccion='$direccion', telefono='$telefono' where id_almacen_cliente=$id_almacen_cliente";
    $conexion->query($instruccion);
    header("Location: modificar-almacen-cliente.php?id_almacen_cliente=$id_almacen_cliente");

} else if (isset($_POST["id_camion"])) {
    $id_camion = $_POST["id_camion"];
    $matricula = $_POST["matricula"];
    $peso_soportado = $_POST["peso_soportado"];
    $volumen_disponible = $_POST["volumen_disponible"];
    $estado = $_POST["estado"];

    $instruccion1 = "update vehiculo set matricula='$matricula', peso_soportado='$peso_soportado', volumen_disponible='$volumen_disponible', estado='$estado' where id_vehiculo=$id_camion";
    $conexion->query($instruccion1);
    header("Location: modificar-camiones.php?id_camion=$id_camion");

} else if (isset($_POST["id_camioneta"])) {
    $id_camioneta = $_POST["id_camioneta"];
    $matricula = $_POST["matricula"];
    $peso_soportado = $_POST["peso_soportado"];
    $volumen_disponible = $_POST["volumen_disponible"];
    $estado = $_POST["estado"];

    $instruccion1 = "update vehiculo set matricula='$matricula', peso_soportado='$peso_soportado', volumen_disponible='$volumen_disponible', estado='$estado' where id_vehiculo=$id_camioneta";
    $conexion->query($instruccion1);
    header("Location: modificar-camioneta.php?id_camioneta=$id_camioneta");

} else if (isset($_POST["id_camionero"])) {
    $id_camionero = $_POST["id_camionero"];
    $cedula = $_POST["cedula"];
    $nombre_completo = $_POST["nombre_completo"];
    $mail = $_POST["mail"];
    $telefono = $_POST["telefono"];

    $numArrays = count($cedula);
    for ($i = 0; $i < $numArrays; $i++) {
        $respuesta = existencia('camionero', 'cedula', $cedula[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe la cedula $cedula[$i]"
            ];
            break;
        }
        $respuesta = existencia('camionero', 'telefono', $telefono[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el telefono $telefono[$i]"
            ];
            break;
        }
        $respuesta = existencia('camionero', 'mail', $mail[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el mail $mail[$i]"
            ];
            break;
        }
        if (!filter_var($mail[$i], FILTER_VALIDATE_EMAIL)) {
            $respuesta = [
                'error' => 'Error',
                'respuesta' => "La dirección de correo electrónico no es válida"
            ];
            break;
        }

        $respuesta = atributosVacio($cedula);
        $respuesta1 = atributosVacio($nombre_completo);
        $respuesta2 = atributosVacio($mail);
        $respuesta3 = atributosVacio($telefono);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {

            $respuesta = longitud($cedula[$i], 8);
            $respuesta1 = longitud($nombre_completo[$i], 45);
            $respuesta2 = longitud($mail[$i], 45);
            $respuesta3 = longitud($telefono[$i], 20);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {

                $respuesta = numeros($cedula[$i]);

                if ($respuesta['error'] !== "Error") {

                    if (preg_match('/^\+\d+(\s\d+)?$/', $telefono[$i]) || ctype_digit($telefono[$i])) {

                        $respuesta = letras($nombre_completo[$i]);

                        if ($respuesta['error'] !== "Error") {

                            $respuesta = [
                                'error' => "Éxito",
                                'respuesta' => "Camionero modificado"
                            ];
                            $instruccion = "update camionero set cedula='$cedula[$i]', nombre_completo='$nombre_completo[$i]', mail='$mail[$i]', telefono='$telefono[$i]' where id_camionero=$id_camionero";
                            $conexion->query($instruccion);

  

                        } else {
                            $respuesta = [
                                'error' => "Error",
                                'respuesta' => "El nombre debe tener solo letras"
                            ];
                        }
                    } else {
                        $respuesta = [
                            'error' => "Error",
                            'respuesta' => "El teléfono no es válido"
                        ];
                    }



                } else {
                    $respuesta = [
                        'error' => "Éxito",
                        'respuesta' => "La cédula debe tener solo números"
                    ];
                }

            } else {
                $respuesta = [
                    'error' => "Éxito",
                    'respuesta' => "Palabras inválidas"
                ];
            }

        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Campos sin completar"
            ];
        }
    }
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: modificar-camionero.php?id_camionero=$id_camionero&datos="  . urlencode($respuesta));

} else if (isset($_POST["id_empresa_cliente"])) {
    $id_empresa = $_POST["id_empresa_cliente"];
    $rut = $_POST["rut"];
    $nombre_de_empresa = $_POST["nombre_de_empresa"];
    $mail = $_POST["mail"];

    $instruccion1 = "update empresa_cliente set rut='$rut', nombre_de_empresa='$nombre_de_empresa', mail='$mail' where id_empresa_cliente=$id_empresa";
    $conexion->query($instruccion1);
    header("Location: modificar-empresa-cliente.php?id_empresa_cliente=$id_empresa");

} else if (isset($_POST["id_plataforma"])) {
    $id_plataforma = $_POST["id_plataforma"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $departamento = $_POST["departamento"];
    $volumen_maximo = $_POST["volumen_maximo"];



    $instruccion1 = "update plataforma set direccion='$direccion', telefono='$telefono', ubicacion='$departamento', volumen_maximo='$volumen_maximo' where id_plataforma=$id_plataforma";
    $conexion->query($instruccion1);
    header("Location: modificar-plataforma.php?id_plataforma=$id_plataforma");

} else if (isset($_POST["nom_usu"])) {
    $nom_usu = $_POST["nom_usu"];
    $tipo_usu = $_POST["tipo_usu"];
    $mail = $_POST["mail"];

    $instruccion1 = "update login set nom_usu='$nom_usu', tipo_usu='$tipo_usu', mail='$mail' where nom_usu='$nom_usu'";
    $conexion->query($instruccion1);
    header("Location: modificar-usuario.php?nom_usu=$nom_usu");
} else if (isset($_POST["icth"])) {
    $id_camioneta_horario = $_POST["icth"];

    $id_almacen_central = $_POST["iac"];
    $fecha_salida = $_POST["fecha_salida"];
    $hora_salida = $_POST["hora_salida"];

    $id_almacenes_cliente = $_POST["iacl"];
    $fechas_recogida = $_POST["fecha_recogida"];
    $horas_recogida = $_POST["hora_recogida"];


    $numArrays = count($id_almacenes_cliente);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");

        $respuesta = atributosVacio($id_camioneta_horario);

        $respuesta1 = atributosVacio($id_almacen_central);
        $respuesta2 = atributosVacio($fecha_salida);
        $respuesta3 = atributosVacio($hora_salida);

        $respuesta4 = atributosVacio($id_almacenes_cliente);
        $respuesta5 = atributosVacio($fechas_recogida);
        $respuesta6 = atributosVacio($horas_recogida);




        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error" && $respuesta5['error'] !== "Error" && $respuesta6['error'] !== "Error") {

        $fecha1 = $fecha_salida[0] . " "  . $hora_salida[0];
        $fecha2 = $fechas_recogida[$i] . " " . $horas_recogida[$i]; 

        $instruccion = "update recoge set fecha_recogida_ideal='$fecha2', id_almacen_cliente='$id_almacenes_cliente[$i] where id_camioneta='$id_camioneta_horario[0]' AND fecha_salida='$fecha1' AND almacen_central_salida='$id_almacen_central[0]'";
        $conexion->query($instruccion);
        }
    }

}




?>