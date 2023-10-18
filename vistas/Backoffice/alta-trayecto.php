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
    <form action="alta-trayecto.php" method="post" id="form-alta-tray">
        <legend>Agregar Trayecto</legend>
        <select name="id_plataforma" class="estilo-select">
            <option disabled selected>Dirección Plataforma</option>
            <?php
            include("../../modelos/db.php");
            $instruccion = "select * from plataforma";
            $plataformas = [];
            $result = mysqli_query($conexion, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($plataformas, $row);
            }
            foreach ($plataformas as $plataforma) {
                $id_plataforma = $plataforma['id_plataforma'];
                $direccion = $plataforma['direccion'];
                $departamento = $plataforma['departamento'];

                echo "<option value='$id_plataforma'>$id_plataforma - $direccion, $departamento</option>";
            }
            ?>
        </select>
        <input type="text" placeholder="Punto intermedio" class="txt-crud txt-intermedio" name="intermedio[]">
        <a href="" id="btn-alta-tray"><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-trayecto.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<script src="../js/alta-tray.js"></script>

<?php


if ($_POST) {
    $id_plataforma = $_POST['id_plataforma'];
    $intermedios = $_POST['intermedio'];
    $intermedios1 = [];

    print_r($intermedios);
    foreach($intermedios as $intermedio){
        if(!isset($intermedio) || is_null($intermedio) || empty(trim($intermedio))){
        } else {
            array_push($intermedios1, $intermedio);
        }
    }
    print_r($intermedios1);
}

?>