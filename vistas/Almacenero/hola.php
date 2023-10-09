<form action="hola.php" method="post">
<input type="text" value="<?= $_GET['id_lote']?>" name="id_lote">

<select name="id_plataforma" id="">
    <?php
    require("../../controladores/api/plataforma/obtenerDato.php");

foreach ($decode as $plataforma) {
    echo "<option value='" . $plataforma['id_plataforma'] . "'>" . $plataforma['direccion'] . " - " .  $plataforma['departamento'] . "</option>";

}
?>
</select>

<select name="id_camion" id="">
    <?php
    require("../../controladores/api/camion/obtenerDato.php");

foreach ($decode as $camion) {
    echo "<option value='" . $camion['id_camion'] . "'>" . $camion['matricula'] . " - " .  $camion['estado'] . "</option>";

}
?>
</select>

<input type="submit" value="Enviar">
</form>
<?php

if($_POST){
    include("../../modelos/db.php");
    $id_lote = $_POST['id_lote'];
    $id_camion = $_POST['id_camion'];
    $id_plataforma = $_POST['id_plataforma'];


    $instruccion = "insert into transporta(id_lote, id_camion) value ('$id_lote', '$id_camion')";
    $conexion->query($instruccion);

    $instruccion = "insert into lleva(id_lote, id_plataforma) value ('$id_lote', '$id_plataforma')";
    $conexion->query($instruccion);
}
?>
