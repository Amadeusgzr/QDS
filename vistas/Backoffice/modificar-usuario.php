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
$id_usuario = $_GET['id_usuario'];
$instruccion = "select * from login where id_usuario='$id_usuario'";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $nom_usu = $fila["nom_usu"];
    $tipo_usu = $fila["tipo_usu"];
    $mail = $fila["mail"];
}

?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class='legend-m-usuario'>Modificar Usuario</legend>
        <p class="subtitulo-crud">Datos actuales</p>

        <input type="text" placeholder="ID" class="txt-crud" name="id_usuario" value="<?= $id_usuario ?>" required readonly hidden>
        
        <p><b class='p-usuario'>Usuario:</b></p>
        <input type="text" placeholder="Usuario" class="txt-crud" name="nom_usu" value="<?= $nom_usu ?>" required readonly>
        
        <p><b class='p-tipo-usuario'>Tipo de usuario: </b></p>
        <select name="tipo_usu" class="txt-crud">
            <option type="text" value="" class="txt-crud" name="tipo_usu[]" required>Tipos de usuario</option>
            <option type="text" value="camionero" class="txt-crud" name="tipo_usu[]" required>Camionero</option>
            <option type="text" value="almacenero" class="txt-crud" name="tipo_usu[]" required>Almacenero</option>
            <option type="text" value="empresa" class="txt-crud" name="tipo_usu[]" required>Empresa</option>
            <option type="text" value="admin" class="txt-crud" name="tipo_usu[]" required>Administrador</option>
        </select>
        
        <p><b class='p-mail'>Mail: </b></p>
        <input type="text" placeholder="Mail" class="txt-crud" name="mail" value="<?= $mail ?>" required>
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-usuarios.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>