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

<div id="div-tabla-lote">
    <h1 id="h1-lote">Paquetes sin asignar</h1>
    <div class="contenedor-tabla">
        <table id="tabla-lote">
            <tr class="fila-ingreso-lote">
                <th>ID del paquete</th>
                <th>Destino</th>
                <th>Estado</th>
                <th>Opciones</th>
                <?php
                require("../../controladores/api/paquete/obtenerDato.php");
                foreach ($decode as $paquete) {
                    if (isset($_GET)) {
                        $id_lote = $_GET['id_lote'];
                    }


                    $id_paquete = $paquete["id_paquete"];
                    if ($paquete['estado'] == "En almacén central") {
                        echo '<tr class="fila-ingreso-lote fila-opcion">';
                        echo '<td>' . $paquete["id_paquete"] . '</td>';
                        echo '<td>' . $paquete["direccion"] . '</td>';
                        echo '<td>' . $paquete['estado'] . '</td>';
                        echo "<td>
                <a href='../../controladores/api/paquete_lote/agregarDato.php?id_paquete=$id_paquete&id_lote=$id_lote'><button>Agregar</button></a>
                </td>";
                        echo '</tr>';
                    }

                }
                ?>
        </table>
    </div>
    <div id="mov-lote">
        <button class="btn-limpiar estilo-boton btns-as-lote">Borrar</button>
        <div id="btns-mov-lote">
            <a href="asignar-paquetes-lote.php">
                <button class="boton-volver estilo-boton btns-as-lote">Volver</button>
            </a>
            <!--a-->
            <a href="hola.php?id_lote=<?= $id_lote ?>"><button
                    class="boton-siguiente estilo-boton btns-as-lote">Siguiente</button></a>
            <!--a-->
        </div>
    </div>
</div>

<h1 id="h1-lote">Paquetes asignados al lote
    <?= $id_lote ?>
</h1>
<div class="contenedor-tabla">
    <table id="tabla-lote">
        <tr class="fila-ingreso-lote">
            <th>ID del paquete</th>
            <th>Destino</th>
            <th>Estado</th>
            <th>Opciones</th>
            <?php
            require("../../controladores/api/paquete_lote/obtenerDatoPorId.php");
            foreach ($decode as $paquete) {
                if (isset($_GET)) {
                    $id_lote = $_GET['id_lote'];
                }

                $id_paquete = $paquete["id_paquete"];
                echo '<tr class="fila-ingreso-lote fila-opcion">';
                echo '<td>' . $paquete["id_paquete"] . '</td>';
                echo '<td>' . $paquete["direccion"] . '</td>';
                echo '<td>' . $paquete["estado"] . '</td>';
                echo "<td>
                <a href='../../controladores/api/paquete_lote/eliminarDato.php?id_paquete=$id_paquete&id_lote=$id_lote'><button>Eliminar</button></a>
                </td>";
                echo '</tr>';
            }
            ?>
    </table>
</div>
<?php
            require("../../controladores/api/plataforma_camion_lote/obtenerDatoPorId.php");
            foreach ($decode as $lote) {
                $id_lote = $lote["id_lote"];
                if(isset($lote['id_plataforma']) && isset($lote['id_camion'])){
                    $id_plataforma = $lote["id_plataforma"];
                    $id_camion = $lote["id_camion"];
                } 
            }    
            if (isset($id_plataforma) && isset($id_camion)){ 
            echo "<form action='../../controladores/api/plataforma_camion_lote/modificarDato.php' method='post'>";
                } else{
                    echo "<form action='../../controladores/api/plataforma_camion_lote/agregarDato.php' method='post'>";
                }        
            ?>
<input type="text" value="<?= $_GET['id_lote']?>" name="id_lote">

<select name="id_plataforma" id="">
    <?php
    require("../../controladores/api/plataforma/obtenerDato.php");
foreach ($decode as $plataforma) {
    if($plataforma['id_plataforma'] == $id_plataforma){
        echo "<option value='" . $plataforma['id_plataforma'] . "' selected>" . $plataforma['direccion'] . " - " .  $plataforma['departamento'] . "</option>";
    } else{
        echo "<option value='" . $plataforma['id_plataforma'] . "'>" . $plataforma['direccion'] . " - " .  $plataforma['departamento'] . "</option>";

    }

}
?>
</select>

<select name="id_camion" id="">
    <?php
    require("../../controladores/api/camion/obtenerDato.php");
foreach ($decode as $camion) {
    if($camion['id_camion'] == $id_camion){
    echo "<option value='" . $camion['id_camion'] . "' selected>" . $camion['matricula'] . " - " .  $camion['estado'] . "</option>";
    } else{
        echo "<option value='" . $camion['id_camion'] . "'>" . $camion['matricula'] . " - " .  $camion['estado'] . "</option>";
    }
}
?>
</select>

<input type="submit" value="Enviar">
</form>




<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>


<script src="../js/asignar-paquetes-lote-2.js"></script>
<script src="../js/mostrar-respuesta.js"></script>
<script>
    // Función para ocultar el parámetro "datos" en la URL
    function ocultarDatosEnURL() {
        if (window.history.replaceState) {
            // Reemplaza la URL actual sin el parámetro "datos"
            const urlSinDatos = window.location.href.replace(/\?datos=.*&/, '?').replace(/\&datos=.*$/, '');
            window.history.replaceState(null, null, urlSinDatos);
        }
    }

    // Llama a la función al cargar la página
    window.onload = ocultarDatosEnURL;
</script>



</body>

</html>