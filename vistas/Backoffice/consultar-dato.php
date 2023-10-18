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
        <legend>Consultar Camionero</legend>
        <p class='subtitulo-crud'>Datos del camionero</p>
        <p><b>ID: </b>$id_camionero</p>
        <p><b>Cédula: </b>$cedula</p>
        <p><b>Nombre: </b>$nombre_completo</p>
        <p><b>Teléfono: </b>$telefono</p>
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
        <legend>Consultar Almacen Cliente</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_cliente</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
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
        <legend>Consultar Almacen Central</legend>
        <p class='subtitulo-crud'>Datos del almacén</p>
        <p><b>ID: </b>$id_almacen_central</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Número de almacén: </b>$numero_almacen</p>
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
        <legend>Consultar Plataforma</legend>
        <p class='subtitulo-crud'>Datos de la plataforma</p>
        <p><b>ID: </b>$id_plataforma</p>
        <p><b>Teléfono: </b>$telefono</p>
        <p><b>Dirección: </b>$direccion</p>
        <p><b>Departamento: </b>$departamento</p>
        <p><b>Volumen máx.: </b>$volumen</p>
        <p><b>Trayecto: </b></p>";
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
        <legend>Consultar Camión</legend>
        <p class='subtitulo-crud'>Datos del camión</p>
        <p><b>ID: </b>$id_camion</p>
        <p><b>Matrícula: </b>$matricula</p>
        <p><b>Peso soportado: </b>$peso_soportado Kg</p>
        <p><b>Volumen disponible: </b>$volumen_disponible Cm3</p>
        <p><b>Estado: </b>$estado</p>
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
        <legend>Consultar Empresa Cliente</legend>
        <p class='subtitulo-crud'>Datos de la empresa</p>
        <p><b>RUT: </b>$rut</p>
        <p><b>Nombre: </b>$nombre_de_empresa</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-empresas.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

} else if (isset($_GET['id_ruta'])) {
    $id_ruta = $_GET['id_ruta'];

    $instruccion = "select * from ruta where id_ruta=$id_ruta";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $id_ruta = $fila["id_ruta"];
        $nom_ruta = $fila["nom_ruta"];

        echo "<div class='form-crud'>
        <legend>Consultar Ruta</legend>
        <p class='subtitulo-crud'>Datos de la ruta</p>
        <p><b>ID: </b>$id_ruta</p>
        <p><b>Nombre/Numero: </b>$nom_ruta</p>
        <a href='op-ruta.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

} else if (isset($_GET['nom_usu'])) {
    $nom_usu = $_GET['nom_usu'];

    $instruccion = "select * from login where nom_usu='$nom_usu'";
    $filas = $conexion->query($instruccion);

    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
        $nom_usu = $fila["nom_usu"];
        $tipo_usu = $fila["tipo_usu"];
        $mail = $fila["mail"];

        echo "<div class='form-crud'>
        <legend>Consultar Usuario</legend>
        <p class='subtitulo-crud'>Datos del usuario</p>
        <p><b>Usuario: </b>$nom_usu</p>
        <p><b>Tipo de Usuario: </b>$tipo_usu</p>
        <p><b>Mail: </b>$mail</p>
        <a href='op-usuarios.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        </div>";
    }

}

?>