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
    <form action="alta-camion.php" method="post">
        <legend class="legend-form">Agregar Camión</legend>
        <input type="text" placeholder="Matrícula" class="txt-crud txt-1" name="matricula[]">
        <input type="text" placeholder="Peso max. (Kg)" class="txt-crud txt-2" name="peso_soportado[]">
        <input type="text" placeholder="Volumen max. (Mts3)" class="txt-crud txt-3" name="volumen_disponible[]">
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente boton-agregar"></a>
    </form>
    <a href="op-camiones.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $matricula = $_POST["matricula"];
    $peso_soportado = $_POST["peso_soportado"];
    $volumen_disponible = $_POST["volumen_disponible"];

    $numArrays = count($matricula);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('camion', 'matricula', $matricula[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe la matricula $matricula[$i]"
            ];
            break;
        }

        $respuesta = atributoVacio($matricula);
        $respuesta1 = atributoVacio($peso_soportado);
        $respuesta2 = atributoVacio($volumen_disponible);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Camión guardado"
            ];
            $instruccion = "insert into camion(matricula, volumen_disponible, peso_soportado, estado) value ('$matricula[$i]', '$volumen_disponible[$i]', '$peso_soportado[$i]', 'Disponible')";
            $conexion->query($instruccion);
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-camion.php?datos=' . urlencode($respuesta));
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