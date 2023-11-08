<?php
session_start();
echo "<link rel='stylesheet' href='css/estilos.css'>";
if (!isset($_SESSION['nom_usu'])) {
    header('Location: permisos.php');
    exit(); 
} else {
     echo "<link rel='stylesheet' href='css/estilos.css'>";
    require 'plantillas/headerSeguimiento.php';
    require 'plantillas/menu-cuentaSeguimiento.php';
}
?>
<div id="div-cambiar-contrasenia">
    <h1 class="h1-tabla2">Cambiar contraseña</h1>
    <p class="adv adv-cambiar">La contraseña debe contener al menos 8 dígitos, una mayúscula, una minúscula y un número.</p>
    <form action="cambiar-contrasenia.php" method="post" id="form-cambiar-contrasenia">

    <div class="div-contrasenia div-contrasenia2">
        <input type="password" name="contrasenia_actual" class="txt-crud txt1 txt-cambiar" id="txt-contrasenia" placeholder="Contraseña actual">
        <img src="img/iconos/ojo-cerrado.png" class="icono-ojo botones ojo1"></img>
    </div>

    <div class="div-contrasenia div-contrasenia2">
        <input type="password" name="contrasenia_cambiar" class="txt-crud txt2 txt-cambiar" id="txt-contrasenia" placeholder="Contraseña nueva">
        <img src="img/iconos/ojo-cerrado.png" class="icono-ojo botones ojo2"></img>
    </div>
    <div class="div-contrasenia div-contrasenia2">
    <input type="password"name="contrasenia_repetir" class="txt-crud txt3 txt-cambiar" id="txt-contrasenia" placeholder="Repetir contraseña nueva">
        <img src="img/iconos/ojo-cerrado.png" class="icono-ojo botones ojo3"></img>
    </div>
    <input type="submit" value="Confirmar" class="estilo-boton">
        </form>

    <div id="mov-lote-lote">
        <a href="../index.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
    </div>
    
</div>

<script src="js/cambiar-contrasenia.js"></script>

<?php
if($_POST){
    require("../modelos/db.php");
    $contrasenia_actual = $_POST["contrasenia_actual"];
    $contrasenia_cambiar = $_POST["contrasenia_cambiar"];
    $contrasenia_repetir = $_POST["contrasenia_repetir"];

    $usuario = $_SESSION["nom_usu"];

    $instruccion = "SELECT * FROM login WHERE nom_usu='$usuario'";
    $resultado = mysqli_query($conexion, $instruccion);
    $fila =  mysqli_fetch_assoc($resultado);

    $contrasenia_real = $fila["contrasenia"];

    if (password_verify($contrasenia_actual, $contrasenia_real)){
        echo "Contraseña correcta";
        if(!password_verify($contrasenia_cambiar, $contrasenia_real)){
        if ($contrasenia_cambiar == $contrasenia_repetir){
            if(preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/', $contrasenia_repetir)){
                echo "Estas seguro de que quieres cambiar la contraseña";
                echo "<form method='get' action='cambiar-contrasenia.php'>
                <input type='text' value='$contrasenia_repetir' name='contrasenia_guardar' hidden>
                <input type='submit'>
                </form>
                ";
            } else{
                echo "La contraseña debe de tener 1 mayúscula, 1 minúscula, un dígito y debe de ser mayor a 8";
            }

        } else {
            echo "Las contraseñas no coinciden";
        }
    } else{
        echo "La contraseña a cambiar es la misma que la actual";
    }
    } else{
        echo "Contraseña incorrecta";
    } 


}


if ($_GET){
    require("../modelos/db.php");

    $contrasenia = $_GET["contrasenia_guardar"];
    $usuario = $_SESSION["nom_usu"];
    $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
    $instruccion =  "UPDATE login SET contrasenia='$contrasenia' WHERE nom_usu='$usuario'";
    mysqli_query($conexion, $instruccion);
    echo "Contraseña guardada correctamente";

}

?>



