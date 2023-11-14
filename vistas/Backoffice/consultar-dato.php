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
        <legend class='legend-c-camionero'>Consultar Camionero</legend>
        <p class='subtitulo-crud'>Datos del camionero</p>
        <p><b class='p-id'>ID: </b>$id_camionero</p>
        <p><b class='p-cedula'>Cédula: </b>$cedula</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_completo</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b>Mail: </b>$mail</p>
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
        <legend class='legend-c-almacen-cliente'>Consultar Almacen Cliente</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b class='p-id'>ID: </b>$id_almacen_cliente</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-direccion'>Dirección: </b>$direccion</p>
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
        <legend class='legend-c-almacen-central'>Consultar Almacen Central</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b class='p-id'>ID: </b>$id_almacen_central</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-numero-almacen'>Número de almacén: </b>$numero_almacen</p>
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
        $departamento = $fila["departamento"];
        $volumen = $fila["volumen_maximo"];

        $api_key = 'AIzaSyD3apFCRO-Fq2fccUb-g6GvinOzsh-vDYM';
        $origen = 'FelipeSanguinetti2474';
        $destino = str_replace(' ', '', $direccion) . ",Departamentode" . $departamento;
        // Construir la URL para la solicitud a la API
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origen&destination=$destino&key=$api_key&region=uy&language=es";

        $response = file_get_contents($url);

        $data = json_decode($response);

        // Realizar la solicitud a la API
        $response = file_get_contents($url);
        echo "<div class='form-crud'>
        <legend class='legend-c-plataforma'>Consultar Plataforma</legend>
        <p class='subtitulo-crud'>Datos de la plataforma</p>
        <p><b class='p-id'>ID: </b>$id_plataforma</p>
        <p><b class='p-telefono'>Teléfono: </b>$telefono</p>
        <p><b class='p-direccion'>Dirección: </b>$direccion</p>
        <p><b class='p-departamento'>Departamento: </b>$departamento</p>
        <p><b class='p-volumen-maximo'>Volumen máx.: </b>$volumen</p>
        <p><b class='p-trayecto'>Trayecto: </b></p>";
        if ($data->status === "OK") {
            // Recuperar las direcciones en texto
            $pasos = $data->routes[0]->legs[0]->steps;
            $direccionesTexto = [];

            $data = json_decode($response);

            foreach ($pasos as $paso) {
                $direccionesTexto[] = $paso->html_instructions;
            }

            // Imprimir las direcciones en texto
            foreach ($direccionesTexto as $direcciones) {
                echo "<p>$direcciones</p>";
            }
        }
        echo "<a href='op-plataforma.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_camion1'])) {
    $id_camion = $_GET['id_camion1'];


    $instruccion = "select * from mostrar_camiones where id_camion=$id_camion";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_camion = $fila["id_camion"];
        $matricula = $fila["matricula"];
        $peso_soportado = $fila["peso_soportado"];
        $volumen_disponible = $fila["volumen_maximo"];
        $peso_total_actual_camion = $fila["peso_total_actual_camion"];
        $volumen_total_actual_camion = $fila["volumen_total_actual_camion"];
        $estado = $fila["estado"];

        echo "<div class='form-crud'>
        <legend class='legend-c-camion'>Consultar Camión</legend>
        <p class='subtitulo-crud'>Datos del camión</p>
        <p><b class='p-id'>ID: </b>$id_camion</p>
        <p><b class='p-matricula'>Matrícula: </b>$matricula</p>
        <p><b class='p-peso-sop'>Peso soportado: </b>$peso_soportado Kg</p>
        <p><b>Peso actual: </b>$peso_total_actual_camion Kg</p>
        <p><b class='p-volumen-disp'>Volumen disponible: </b>$volumen_disponible Cm3</p>
        <p><b>Volumen actual: </b>$volumen_total_actual_camion Cm3</p>
        <p><b class='p-estado'>Estado: </b>$estado</p>
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
            <legend class='legend-c-camioneta'>Consultar Camioneta</legend>
            <p class='subtitulo-crud'>Datos de la camioneta</p>
            <p><b class='p-id'>ID: </b>$id_camioneta</p>
            <p><b class='p-matricula'>Matrícula: </b>$matricula</p>
            <p><b class='p-peso-sop'>Peso soportado: </b>$peso_soportado Kg</p>
            <p><b class='p-volumen-disp'>Volumen disponible: </b>$volumen_disponible Cm3</p>
            <p><b class='p-estado'>Estado: </b>$estado</p>
            <a href='op-camionetas.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
            </div>";
    }
} else if (isset($_GET['id_empresa_cliente'])) {
    $id_empresa_cliente = $_GET['id_empresa_cliente'];


    $instruccion = "select * from empresa_cliente where id_empresa_cliente=$id_empresa_cliente";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_empresa = $fila["id_empresa_cliente"];
        $rut = $fila["rut"];
        $nombre_de_empresa = $fila["nombre_de_empresa"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend class='legend-c-empresa-cliente'>Consultar Empresa Cliente</legend>
        <p class='subtitulo-crud'>Datos de la empresa</p>
        <p><b class='p-id'>ID: </b>$id_empresa</p>
        <p><b class='p-cedula'>RUT: </b>$rut</p>
        <p><b class='p-nombre'>Nombre: </b>$nombre_de_empresa</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-empresas-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }
} else if (isset($_GET['id_camioneta_horario'])) {
    $id_camioneta = $_GET['id_camioneta_horario'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];

    $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida'";
    $filas = $conexion->query($instruccion);
    $filas = $filas->fetch_all(MYSQLI_ASSOC);

    if (count($filas) > 0) {
        foreach ($filas as $fila) {
            $matricula = $fila["matricula"];
            $fecha_salida = $fila["fecha_salida"];
        }
    }
    echo "
    <div class='form-crud'>
    <legend>Eliminar Horario</legend>
    <p class='adv'>¿Seguro que quiere eliminar el siguiente horario? Los cambios serán irreversibles</p>
    <p>Datos de salida</p>
    <p><b>Matricula: </b>$matricula</p>
    <p><b>Fecha salida: </b>$fecha_salida</p>";

    $instruccion = "select * from recoge inner join camioneta on recoge.id_camioneta = camioneta.id_camioneta inner join vehiculo on vehiculo.id_vehiculo = camioneta.id_camioneta inner join almacen_cliente on recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join tiene on tiene.id_almacen_cliente = almacen_cliente.id_almacen_cliente inner join empresa_cliente on tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente where camioneta.id_camioneta=$id_camioneta AND fecha_salida='$fecha_salida' ORDER BY fecha_recogida_ideal ASC;";
    $filas = $conexion->query($instruccion);

    $puntosIntermedios = [];

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        echo "<hr>";
        $id_almacen_cliente = $fila["id_almacen_cliente"];
        $fecha_recogida_ideal = $fila["fecha_recogida_ideal"];
        $direccion_almacen = $fila["direccion"];
        $empresa = $fila["nombre_de_empresa"];

        $direccion_completa = $direccion_almacen . ", Departamento de Montevideo";
        array_push($puntosIntermedios, $direccion_completa);


        echo "
        <p><b>Almacen cliente: </b>$direccion_almacen - $empresa</p>
        <p><b>Fecha recogida estimado: </b>$fecha_recogida_ideal</p>";
    }

    echo "<a href='detalles-horarios-recogida.php?id_camioneta_horario=$id_camioneta&fs=$fecha_salida&acs=$almacen_central_salida'><button class='btn-op btn-op3'><img src='../img/iconos/consultar.png' width='20px'></button></a>";

    echo "<a href='op-gestion-paquete-recogida.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>";
} else if (isset($_GET['id_camion_horario'])) {
    $id_camion = $_GET['id_camion_horario'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];

    $instruccion = "select * from lleva inner join camion on lleva.id_camion = camion.id_camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion where camion.id_camion=$id_camion AND fecha_salida='$fecha_salida'";
    $filas = $conexion->query($instruccion);
    $filas = $filas->fetch_all(MYSQLI_ASSOC);

    if (count($filas) > 0) {
        foreach ($filas as $fila) {
            $matricula = $fila["matricula"];
            $fecha_salida = $fila["fecha_salida"];
        }
    }
    echo "
    <div class='form-crud'>
    <legend>Eliminar Horario</legend>
    <p class='adv'>¿Seguro que quiere eliminar el siguiente horario? Los cambios serán irreversibles</p>
    <p>Datos de salida</p>
    <p><b>Matricula: </b>$matricula</p>
    <p><b>Fecha salida: </b>$fecha_salida</p>";

    $instruccion = "select * from lleva inner join camion on lleva.id_camion = camion.id_camion inner join vehiculo on vehiculo.id_vehiculo = camion.id_camion inner join plataforma on lleva.id_plataforma = plataforma.id_plataforma inner join destino on plataforma.ubicacion = destino.id_destino where camion.id_camion=$id_camion AND fecha_salida='$fecha_salida' ORDER BY fecha_entrega_ideal ASC;";
    $filas = $conexion->query($instruccion);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        echo "<hr>";
        $id_plataforma = $fila["id_plataforma"];
        $fecha_entrega_ideal = $fila["fecha_entrega_ideal"];
        $direccion_plataforma = $fila["direccion"];
        $departamento_plataforma = $fila["departamento_destino"];

        echo "
        <p><b>Plataforma: </b>$direccion_plataforma, $departamento_plataforma</p>
        <p><b>Fecha de entrega estimado: </b>$fecha_entrega_ideal</p>";
    }

    echo "<a href='op-gestion-paquete-recogida.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    </div>";
}
?>