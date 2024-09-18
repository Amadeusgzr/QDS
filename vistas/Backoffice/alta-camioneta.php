<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../../controladores/funciones.php';
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="alta-camioneta.php" method="post">
        <legend class="legend-form">Agregar Camioneta</legend>
        <input type="text" placeholder="Matrícula" class="txt-crud txt-1" name="matricula[]" maxlength="8" required>
        <input type="text" placeholder="Peso max. (Kg)" class="txt-crud txt-2" name="peso_soportado[]" maxlength="11" required>
        <input type="text" placeholder="Volumen max. (Mts3)" class="txt-crud txt-3" name="volumen_disponible[]" maxlength="11" required>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente boton-agregar"></a>
    </form>
    <a href="op-camionetas.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $matricula = $_POST["matricula"];
    $peso_soportado = $_POST["peso_soportado"];
    $volumen_disponible = $_POST["volumen_disponible"];

    $numArrays = count($matricula);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('vehiculo', 'matricula', $matricula[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe la matricula $matricula[$i]"
            ];
            break;
        }

        $respuesta = atributosVacio($matricula);
        $respuesta1 = atributosVacio($peso_soportado);
        $respuesta2 = atributosVacio($volumen_disponible);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
            $respuesta = longitud($matricula[$i], 8);
            $respuesta1 = longitud($peso_soportado[$i], 11);
            $respuesta2 = longitud($volumen_disponible[$i], 11);



            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {

            $respuesta = numeros($peso_soportado[$i]);
            $respuesta1 = numeros($volumen_disponible[$i]);
                if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error"){
                    if (preg_match('/^(STM)-[0-9]{4}$/', $matricula[$i])) {
                        $respuesta = [
                            'error' => "Éxito",
                            'respuesta' => "Camioneta guardada"
                        ];
                        $instruccion = "insert into vehiculo(matricula, volumen_maximo, peso_soportado, estado) value ('$matricula[$i]', '$volumen_disponible[$i]', '$peso_soportado[$i]', 'Disponible')";
                        $conexion->query($instruccion);
                        $id_camioneta = mysqli_insert_id($conexion);
                        $instruccion = "insert into camioneta(id_camioneta) value ('$id_camioneta')";
                        $conexion->query($instruccion);
                    } else {
                        $respuesta = [
                            'error' => "Error",
                            'respuesta' => "Formato erróneo de matrícula"
                        ];
                    }

                } else{
                    $respuesta = [
                        'error' => "Error",
                        'respuesta' => "El peso y el volumen deben ser números"
                    ];
                }

            } else{
                $respuesta = [
                    'error' => "Error",
                    'respuesta' => "Palabras inválidas"
                ];
            }
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-camioneta.php?datos=' . urlencode($respuesta));
}
?>
<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>