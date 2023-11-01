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
    <form action="alta-usuario.php" method="post">
        <legend class="legend-usuarios">Agregar Usuario</legend>
        <input type="text" placeholder="Usuario" class="txt-crud txt1" name="nom_usu[]" required>
        <input type="text" placeholder="Tipo de Usuario" class="txt-crud txt2" name="tipo_usu[]" required>
        <input type="mail" placeholder="Mail" class="txt-crud" name="mail[]" required>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente boton-agregar"></a>
    </form>
    <a href="op-usuarios.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php
if ($_POST) {
    $nom_usu = $_POST["nom_usu"];
    $tipo_usu = $_POST["tipo_usu"];
    $mail = $_POST["mail"];

    $numArrays = count($nom_usu);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('login', 'nom_usu', $nom_usu[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el usuario $nom_usu[$i]"
            ];
            break;
        }
        $respuesta = existencia('login', 'mail', $mail[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe un usuario con mail $mail[$i]"
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

        $respuesta = atributosVacio($nom_usu);
        $respuesta1 = atributosVacio($tipo_usu);
        $respuesta2 = atributosVacio($mail);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error") {
            $respuesta = [
                'error' => "Éxito",
                'respuesta' => "Usuario guardado"
            ];
            $instruccion = "insert into login(nom_usu, tipo_usu, mail, contrasenia) value ('$nom_usu[$i]', '$tipo_usu[$i]', '$mail[$i]', '$nom_usu[$i]')";
            $conexion->query($instruccion);
        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Hay atributos que no deben estar vacíos"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-usuario.php?datos=' . urlencode($respuesta));
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