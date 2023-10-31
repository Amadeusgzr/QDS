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
    <form action="alta-almacen-cliente.php" method="post">
        <legend>Agregar Almacén Cliente</legend>
        <input type="text" placeholder="Teléfono" class="txt-crud" name="telefono[]" required>
        <input type="tel" placeholder="Dirección" class="txt-crud" name="direccion[]" required>
        <select name="id_empresa_cliente[]" class="estilo-select">
            <option value="" selected>Empresa</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from empresa_cliente";
            $empresas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($empresas, $row);
            }
            foreach ($empresas as $empresa) {
                $id_empresa_cliente = $empresa['id_empresa_cliente'];
                $nombre_de_empresa = $empresa['nombre_de_empresa'];

                echo "<option value='$id_empresa_cliente'>$nombre_de_empresa</option>";
            }
            ?>
        </select>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-almacen-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $id_empresa_cliente = $_POST["id_empresa_cliente"];

    $numArrays = count($telefono);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('almacen_cliente', 'telefono', $telefono[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el telefono $telefono[$i]"
            ];
            break;
        }

        $respuesta = atributosVacio($telefono);
        $respuesta1 = atributosVacio($direccion);
        $respuesta2 = atributosVacio($id_empresa_cliente);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Almacén guardado"
            ];
            $instruccion = "insert into almacen_cliente(direccion, telefono) value ('$direccion[$i]', '$telefono[$i]')";
            $conexion->query($instruccion);

            $id_almacen_cliente = mysqli_insert_id($conexion);
            
            $instruccion = "insert into tiene(id_almacen_cliente, id_empresa_cliente) value ('$id_almacen_cliente', '$id_empresa_cliente[$i]')";
            $conexion->query($instruccion);
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-almacen-cliente.php?datos=' . urlencode($respuesta));
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