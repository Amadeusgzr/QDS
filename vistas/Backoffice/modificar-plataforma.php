<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<?php
include("../../modelos/db.php");
$id_plataforma = $_GET['id_plataforma'];
$instruccion = "select * from plataforma inner join destino on plataforma.ubicacion = destino.id_destino where id_plataforma=$id_plataforma";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_plataforma = $fila["id_plataforma"];
    $telefono = $fila["telefono"];
    $direccion = $fila["direccion"];
    $ubicacion = $fila["ubicacion"];
    $volumen = $fila["volumen_maximo"];
}


?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-plataforma">Modificar Plataforma</legend>
        <label><b class='p-id'>ID:</b> <?= $id_plataforma?></label>
        <input type="text" name="id_plataforma" value="<?=$id_plataforma?>" required hidden>


        <label><b class="p-telefono">Teléfono: </b></label>
        <input type="tel" placeholder="Teléfono" class="txt-crud txt1" name="telefono" value="<?= $telefono ?>" required>

        <label><b class="p-direccion">Dirección: </b></label>
        <input type="text" placeholder="Dirección" class="txt-crud txt2" name="direccion" value="<?= $direccion ?>" required>

        <label><b class="p-departamento">Departamento: </b></label>
        <select name="departamento" class="txt-crud">
      <?php
      $instruccion = "select * from destino";
      $destinos = [];
      $result = mysqli_query($conexion, $instruccion);
      while ($row = mysqli_fetch_assoc($result)) {
          array_push($destinos, $row);
      }
      foreach ($destinos as $destino) {
          $id_destino = $destino['id_destino'];
          $departamento = $destino['departamento_destino'];
          if ($id_destino == $ubicacion) {
          echo "<option value='$id_destino' selected>$departamento</option>";
          } else{
            echo "<option value='$id_destino'>$departamento</option>";
          }
      }
      ?>
    </select>
        <label><b class="p-volumen-maximo">Volumen máx: </b></label>
        <input type="text" placeholder="Volumen máx." class="txt-crud txt4" name="volumen_maximo" value="<?= $volumen ?>" required>
        
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-plataforma.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>