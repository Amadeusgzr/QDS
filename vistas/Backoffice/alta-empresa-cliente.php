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
    <form action="alta-empresa-cliente.php" method="post">
        <legend>Agregar Empresa Cliente</legend>
        <input type="text" placeholder="RUT" class="txt-crud" name="rut[]" required>
        <input type="text" placeholder="Nombre" class="txt-crud" name="nombre_de_empresa[]" required>
        <input type="tel" placeholder="Mail" class="txt-crud" name="mail[]" required>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-empresas-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $rut = $_POST["rut"];
    $nombre_de_empresa = $_POST["nombre_de_empresa"];
    $mail = $_POST["mail"];

    $numArrays = count($rut);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('empresa_cliente', 'rut', $rut[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el rut $rut[$i]"
            ];
            break;
        }
        $respuesta = existencia('empresa_cliente', 'mail', $mail[$i]);
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
                'respuesta' => "La dirección de correo electrónico no es válida $mail[$i]"
            ];
            break;
        }

        $respuesta = atributoVacio($rut);
        $respuesta1 = atributoVacio($nombre_de_empresa);
        $respuesta2 = atributoVacio($mail);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Empresa guardada"
            ];
            $instruccion = "insert into empresa_cliente(rut, nombre_de_empresa, mail) value ('$rut[$i]', '$nombre_de_empresa[$i]', '$mail[$i]')";
            $conexion->query($instruccion);
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-empresa-cliente.php?datos=' . urlencode($respuesta));
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