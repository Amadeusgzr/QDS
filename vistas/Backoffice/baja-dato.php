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

if (isset($_GET['id_camionero'])) {
    $id_camionero = $_GET['id_camionero'];


    $instruccion = "select * from camionero where id_camionero=$id_camionero";

    $filas = $conexion->query($instruccion);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $cedula = $fila["cedula"];
        $nombre_completo = $fila["nombre_completo"];
        $telefono = $fila["telefono"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend>Eliminar Camionero</legend>
        <p class='adv'>¿Seguro que quiere eliminar al siguiente camionero? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del camionero</p>
        <p><b>ID: </b>$id_camionero</p>
        <p><b>Cédula: </b>$cedula</p>
        <p><b>Nombre: </b>$nombre_completo</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Mail: </b>$mail</p>
        <a href='eliminar.php?id_camionero=$id_camionero'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-camioneros.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_almacen_cliente'])) {
    $id_almacen_cliente = $_GET['id_almacen_cliente'];


    $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];
        echo "<div class='form-crud'>
        <legend>Eliminar Almacen Cliente</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente almacén? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_cliente</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <a href='eliminar.php?id_almacen_cliente=$id_almacen_cliente'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-almacen-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }



} else if (isset($_GET['id_almacen_central'])) {
    $id_almacen_central = $_GET['id_almacen_central'];


    $instruccion = "select * from almacen_central where id_almacen_central=$id_almacen_central";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_central = $fila["id_almacen_central"];
        $telefono = $fila["telefono"];
        $numero_almacen = $fila["numero_almacen"];
        echo "<div class='form-crud'>
        <legend>Eliminar Almacen Central</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente almacén? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_central</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Número de almacén: </b>$numero_almacen</p>
        <a href='eliminar.php?id_almacen_central=$id_almacen_central'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-almacen-central.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_plataforma'])) {
    $id_plataforma = $_GET['id_plataforma'];


    $instruccion = "select * from plataforma where id_plataforma=$id_plataforma";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_plataforma = $fila["id_plataforma"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];
        echo "<div class='form-crud'>
        <legend>Eliminar Plataforma</legend>
        <p class='adv'>¿Seguro que quiere eliminar la siguiente plataforma? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos de la plataforma</p>
        <p><b>ID: </b>$id_plataforma</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <a href='eliminar.php?id_plataforma=$id_plataforma'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-plataforma.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_camion'])) {
    $id_camion = $_GET['id_camion'];


    $instruccion = "select * from camion where id_camion=$id_camion";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_camion = $fila["id_camion"];
        $matricula = $fila["matricula"];
        $peso_soportado = $fila["peso_soportado"];
        $volumen_disponible = $fila["volumen_disponible"];
        $estado = $fila["estado"];
        echo "<div class='form-crud'>
        <legend>Eliminar Camión</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente camión? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del camión</p>
        <p><b>ID: </b>$id_camion</p>
        <p><b>Matrícula: </b>$matricula</p>
        <p><b>Peso soportado: </b>$peso_soportado Kg</p>
        <p><b>Volumen disponible: </b>$volumen_disponible Cm3</p>
        <p><b>Estado: </b>$estado</p>
        <a href='eliminar.php?id_camion=$id_camion'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-camiones.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['rut'])) {
    $rut = $_GET['rut'];


    $instruccion = "select * from empresa_cliente where rut=$rut";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $rut = $fila["rut"];
        $nombre_de_empresa = $fila["nombre_de_empresa"];
        $mail = $fila["mail"];
        echo "<div class='form-crud'>
        <legend>Eliminar Empresa Cliente</legend>
        <p class='adv'>¿Seguro que quiere eliminar la siguiente empresa? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos de la empresa</p>
        <p><b>RUT: </b>$rut</p>
        <p><b>Nombre: </b>$nombre_de_empresa</p>
        <p><b>Mail: </b>$mail</p>
        <a href='eliminar.php?rut=$rut'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-empresas.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_trayecto'])) {
    $id_trayecto = $_GET['id_trayecto'];


    $instruccion = "SELECT trayecto.id_trayecto, plataforma.direccion, plataforma.departamento FROM trayecto INNER JOIN plataforma ON trayecto.id_plataforma=plataforma.id_plataforma WHERE id_trayecto=$id_trayecto";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_trayecto = $fila["id_trayecto"];
        $direccion = $fila['direccion'];
        $departamento = $fila['departamento'];
        echo "<div class='form-crud'>
        <legend>Eliminar Trayecto</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente trayecto? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del trayecto</p>
        <p><b>ID: </b>$id_trayecto</p>
        <p><b>Dirección final: </b>$direccion</p>
        <p><b>Departamento final: </b>$departamento</p>
        <a href='eliminar.php?id_trayecto=$id_trayecto'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-trayecto.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_ruta'])) {
    $id_ruta = $_GET['id_ruta'];


    $instruccion = "select * from ruta where id_ruta=$id_ruta";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_ruta = $fila["id_ruta"];
        $nom_ruta = $fila['nom_ruta'];
        echo "<div class='form-crud'>
        <legend>Eliminar Ruta</legend>
        <p class='adv'>¿Seguro que quiere eliminar la siguiente ruta? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos de la ruta</p>
        <p><b>ID: </b>$id_ruta</p>
        <p><b>Nombre/Numero: </b>$nom_ruta</p>
        <a href='eliminar.php?id_ruta=$id_ruta'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-ruta.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
}

?>