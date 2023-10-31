<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<div id="div-elegir-lote">
    <h1 class="h1-tabla2">Asignar paquetes a lote</h1>
    <p class="adv">El lote al cual se le quiera asignar los paquetes ya debe estar creado</p>
    <form action="asignar-paquetes-lote-2.php" method="get" class="form-asignar">
        <select name="id_lote" id="select-lote">
            <?php
            require("../../controladores/api/lote/obtenerDato.php");
            foreach ($decode as $lote) {
                $id_lote = $lote["id_lote"];
                echo "<option value='$id_lote'>Lote $id_lote</option>";
            }

            ?>
        </select>
        <button class="boton-siguiente estilo-boton">Siguiente</button>
    </form>

    <div id="mov-lote-lote">
        <a href="index.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
    </div>
</div>

</body>

</html>