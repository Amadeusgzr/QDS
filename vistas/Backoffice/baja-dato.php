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
        <legend class='legend-baja-camionero'>Eliminar Camionero</legend>
        <p class='adv'>¿Seguro que quiere eliminar al siguiente camionero? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del camionero</p>
        <p><b class='p-id'>ID: </b>$id_camionero</p>
        <p><b class='p-cedula'>Cédula: </b>$cedula</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_completo</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b>Mail: </b>$mail</p>
        <a href='eliminar.php?id_camionero=$id_camionero'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
        <a href='op-camioneros.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_almacen_cliente'])) {
    $id_almacen_cliente = $_GET['id_almacen_cliente'];
    $paquete = [];
    $instruccion = "select * from almacena where id_almacen_cliente=$id_almacen_cliente";
    $resultado = mysqli_query($conexion, $instruccion);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        array_push($paquete, $fila);
    }
    
    $instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
    $filas = $conexion->query($instruccion);

    

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $telefono = $fila["telefono"];
        $direccion = $fila["direccion"];
        echo "<div class='form-crud'>
        <legend class='legend-baja-almacen-cliente'>Eliminar Almacen Cliente</legend>";
        if (isset($paquete)){
            if (count($paquete) > 0) {
                $cant_paquetes = count($paquete);
                echo "<p class='adv adv-1'>Este almacén tiene $cant_paquetes paquete(s)</p>";
            } else {
                echo "<p class='adv adv-3'>¿Seguro que quiere eliminar el siguiente almacén? Los cambios serán irreversibles.</p>";
            }
        }
    
        echo "<p class='subtitulo-crud'>Datos del almacén</p>
        <p><b class='p-id'>ID: </b>$id_almacen_cliente</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-direccion'>Dirección: </b>$direccion</p>
        <a href='eliminar.php?id_almacen_cliente=$id_almacen_cliente'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
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
        <legend class='legend-baja'>Eliminar Almacen Central</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente almacén? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b class='p-id'>ID: </b>$id_almacen_central</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-numero-almacen'>Número de almacén: </b>$numero_almacen</p>
        <a href='eliminar.php?id_almacen_central=$id_almacen_central'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
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
        <legend class='legend-baja-plataforma'>Eliminar Plataforma</legend>
        <p class='adv'>¿Seguro que quiere eliminar la siguiente plataforma? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos de la plataforma</p>
        <p><b class='p-id'>ID: </b>$id_plataforma</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-direccion'>Dirección: </b>$direccion</p>
        <a href='eliminar.php?id_plataforma=$id_plataforma'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
        <a href='op-plataforma.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_camion'])) {
    $id_camion = $_GET['id_camion'];


    $instruccion = "select * from camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion where id_camion=$id_camion";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_camion = $fila["id_camion"];
        $matricula = $fila["matricula"];
        $peso_soportado = $fila["peso_soportado"];
        $volumen_disponible = $fila["volumen_maximo"];
        $estado = $fila["estado"];
        echo "<div class='form-crud'>
        <legend class='legend-baja-camion'>Eliminar Camión</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente camión? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del camión</p>
        <p><b class='p-id'>ID: </b>$id_camion</p>
        <p><b class='p-matricula'>Matrícula: </b>$matricula</p>
        <p><b class='p-peso-sop'>Peso soportado: </b>$peso_soportado Kg</p>
        <p><b class='p-volumen-disp'>Volumen disponible: </b>$volumen_disponible Cm3</p>
        <p><b class='p-estado'>Estado: </b>$estado</p>
        <a href='eliminar.php?id_camion=$id_camion'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
        <a href='op-camiones.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_camioneta'])) {
    $id_camioneta = $_GET['id_camioneta'];


    $instruccion = "select * from camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where id_camioneta=$id_camioneta";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_camioneta = $fila["id_camioneta"];
        $matricula = $fila["matricula"];
        $peso_soportado = $fila["peso_soportado"];
        $volumen_disponible = $fila["volumen_maximo"];
        $estado = $fila["estado"];
        echo "<div class='form-crud'>
        <legend class='legend-baja'>Eliminar Camión</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente camión? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del camión</p>
        <p><b class='p-id'>ID: </b>$id_camioneta</p>
        <p><b class='p-matricula'>Matrícula: </b>$matricula</p>
        <p><b class='p-peso-sop'>Peso soportado: </b>$peso_soportado Kg</p>
        <p><b class='p-volumen-disp'>Volumen disponible: </b>$volumen_disponible Cm3</p>
        <p><b class='p-estado'>Estado: </b>$estado</p>
        <a href='eliminar.php?id_camioneta=$id_camioneta'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
        <a href='op-camionetas.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
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
} else if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];


    $instruccion = "select * from login where id_usuario='$id_usuario'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $nom_usu = $fila["nom_usu"];
        $tipo_usu = $fila["tipo_usu"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend class='legend-b-usuario'>Eliminar Usuario</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente usuario? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del usuario</p>
        <p><b class='p-usuario'>Usuario: </b>$nom_usu</p>
        <p><b class='p-tipo-usuario'>Tipo de Usuario: </b>$tipo_usu</p>
        <p><b class='p-mail'>Mail: </b>$mail</p>
        <a href='eliminar.php?id_usuario=$id_usuario'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-usuarios.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_empresa_cliente'])) {
    $id_empresa_cliente = $_GET['id_empresa_cliente'];


    $instruccion = "select * from empresa_cliente where id_empresa_cliente='$id_empresa_cliente'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_empresa = $fila["id_empresa_cliente"];
        $rut = $fila["rut"];
        $nombre_de_empresa = $fila["nombre_de_empresa"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend class='legend-baja-empresa'>Eliminar Empresa Cliente</legend>
        <p class='adv'>¿Seguro que quiere eliminar la siguiente empresa? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos de la empresa</p>
        <p><b class='p-id'>ID: </b>$id_empresa</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_de_empresa</p>
        <p><b class='p-cedula'>RUT: </b>$rut</p>
        <p><b>Mail: </b>$mail</p>
        <a href='eliminar.php?id_empresa_cliente=$id_empresa'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
        <a href='op-empresas-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
}   else if (isset($_GET['icth'])) {
    $id_camioneta = $_GET['icth'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];


    $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $matricula = $fila["matricula"];
        $fecha_salida = $fila["fecha_salida"];
    }

    echo "
    <div class='form-crud'>
    <legend class='legend-baja-horario'>Eliminar Horario</legend>
    <p class='adv'>¿Seguro que quiere eliminar el siguiente horario? Los cambios serán irreversibles</p>
    <p class='p-datos-de-salida'>Datos de salida</p>
    <p><b class='p-matricula'>Matricula: </b>$matricula</p>
    <p><b class='p-fecha-salida'>Fecha salida: </b>$fecha_salida</p>";

    $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta inner join almacen_cliente on recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join tiene on tiene.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida' ORDER BY fecha_recogida_ideal ASC;";
    $filas = $conexion->query($instruccion);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        echo "<hr>";
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $fecha_recogida_ideal = $fila["fecha_recogida_ideal"];
        $direccion_almacen = $fila["direccion"];
        $empresa = $fila["nombre_de_empresa"];

        
        echo "
        <p><b class='p-almacen-cliente'>Almacen cliente: </b>$direccion_almacen - $empresa</p>
        <p><b class='p-fecha-recogida-estimada'>Fecha recogida estimado: </b>$fecha_recogida_ideal</p>
        ";
    } 

    echo "<a href='eliminar.php?icth=$id_camioneta&&fs=$fecha_salida&acs=$almacen_central_salida'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
    <a href='op-gestion-paquete-recogida.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>";

} else if (isset($_GET['id_maneja'])) {
    $id_maneja = $_GET['id_maneja'];

    $instruccion = "select * from maneja inner join vehiculo on maneja.id_vehiculo = vehiculo.id_vehiculo inner join camionero on maneja.id_camionero = camionero.id_camionero where maneja.id_maneja=$id_maneja";
    $filas = $conexion->query($instruccion);
    $filas = $filas->fetch_all(MYSQLI_ASSOC);
    foreach ($filas as $fila){
        $matricula = $fila["matricula"];
        $nombre_completo = $fila["nombre_completo"];

        echo "<div class='form-crud'>
        <legend class='legend-baja-relacion'>Desvincular camión y vehículo</legend>
        <p class='adv'>¿Seguro que quiere eliminar la siguiente relación? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos de la relación</p>
        <p><b class='p-id'>ID: </b>$matricula</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_completo</p>
        <a href='eliminar.php?id_maneja=$id_maneja'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
        <a href='op-camionero-vehiculo.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
}  else if (isset($_GET['nom_usu'])) {
    $nom_usu = $_GET['nom_usu'];


    $instruccion = "select * from login where nom_usu='$nom_usu'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $nombre_usu = $fila["nom_usu"];
        $tipo_usu = $fila["tipo_usu"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend>Eliminar Usuario</legend>
        <p class='adv'>¿Seguro que quiere eliminar el siguiente usuario? Los cambios serán irreversibles</p>
        <p class='subtitulo-crud'>Datos del usuario</p>
        <p><b>Usuario: </b>$nombre_usu</p>
        <p><b>Tipo de Usuario: </b>$tipo_usu</p>
        <p><b>Mail: </b>$mail</p>
        <a href='eliminar.php?nom_usu=$nom_usu'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente'></a>
        <a href='op-usuarios.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_camion_horario'])) {
    $id_camion = $_GET['id_camion_horario'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];


    $instruccion = "select * from lleva inner join camion on lleva.id_camion = camion.id_camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion where camion.id_camion=$id_camion AND fecha_salida='$fecha_salida'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $matricula = $fila["matricula"];
        $fecha_salida = $fila["fecha_salida"];
    }

    echo "
    <div class='form-crud'>
    <legend class='legend-baja-horario'>Eliminar Horario</legend>
    <p class='adv'>¿Seguro que quiere eliminar el siguiente horario? Los cambios serán irreversibles</p>
    <p class='p-datos-de-salida'>Datos de salida</p>
    <p><b class='p-matricula'>Matricula: </b>$matricula</p>
    <p><b class='p-fecha-salida'>Fecha salida: </b>$fecha_salida</p>";

    $instruccion = "select * from lleva inner join camion on lleva.id_camion = camion.id_camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion inner join plataforma on lleva.id_plataforma = plataforma.id_plataforma where camion.id_camion=$id_camion AND fecha_salida='$fecha_salida' ORDER BY fecha_entrega_ideal ASC;";
    $filas = $conexion->query($instruccion);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        echo "<hr>";
        $id_plataforma = $fila["id_plataforma"];
        $fecha_entrega_ideal = $fila["fecha_entrega_ideal"];
        $direccion_plataforma = $fila["direccion"];
        
        echo "
        <p><b class='p-almacen-cliente'>Almacen cliente: </b>$direccion_plataforma</p>
        <p><b class='p-fecha-recogida-estimada'>Fecha recogida estimado: </b>$fecha_entrega_ideal</p>
        ";
    } 

    echo "<a href='eliminar.php?id_camion_horario=$id_camion&&fs=$fecha_salida&acs=$almacen_central_salida'><input type='submit' value='Eliminar' class='estilo-boton boton-siguiente boton-eliminar'></a>
    <a href='op-gestion-lote-entrega.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>";

}

?>