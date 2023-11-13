<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../../controladores/funciones.php';
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>

<div class="form-crud">
    <form action="alta-camionero.php" method="post">
        <legend class="legend-form">Agregar Camionero</legend>
        <input type="text" placeholder="Cédula" class="txt-crud txt-1" name="cedula[]" required maxlength="8">
        <input type="text" placeholder="Nombre Completo" class="txt-crud txt-2" name="nombre_completo[]" required
            maxlength="45">
        <input type="tel" placeholder="Teléfono" class="txt-crud txt-3" name="telefono[]" required maxlength="20">
        <input type="mail" placeholder="Mail" class="txt-crud" name="mail[]" required maxlength="45">
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente boton-agregar"></a>
    </form>
    <a href="op-camioneros.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php
if ($_POST) {
    $cedula = $_POST["cedula"];
    $nombre_completo = $_POST["nombre_completo"];
    $telefono = $_POST["telefono"];
    $mail = $_POST["mail"];

    $numArrays = count($cedula);
    for ($i = 0; $i < $numArrays; $i++) {
        include("../../modelos/db.php");
        $respuesta = existencia('camionero', 'cedula', $cedula[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe la cedula $cedula[$i]"
            ];
            break;
        }
        $respuesta = existencia('camionero', 'telefono', $telefono[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el telefono $telefono[$i]"
            ];
            break;
        }
        $respuesta = existencia('camionero', 'mail', $mail[$i]);
        if ($respuesta['error'] == "Error") {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Ya existe el mail $mail[$i]"
            ];
            break;
        }
        if (!filter_var($mail[$i], FILTER_VALIDATE_EMAIL)) {
            $respuesta = [
                'error' => 'Error',
                'respuesta' => "La dirección de correo electrónico no es válida"
            ];
            break;
        }

        $respuesta = atributosVacio($cedula);
        $respuesta1 = atributosVacio($nombre_completo);
        $respuesta2 = atributosVacio($mail);
        $respuesta3 = atributosVacio($telefono);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {

            $respuesta = longitud($cedula[$i], 8);
            $respuesta1 = longitud($nombre_completo[$i], 45);
            $respuesta2 = longitud($mail[$i], 45);
            $respuesta3 = longitud($telefono[$i], 20);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error") {

                $respuesta = numeros($cedula[$i]);

                if ($respuesta['error'] !== "Error") {

                    if (preg_match('/^\+\d+(\s\d+)?$/', $telefono[$i]) || ctype_digit($telefono[$i])) {

                        $respuesta = letras($nombre_completo[$i]);

                        if ($respuesta['error'] !== "Error") {

                            $respuesta = [
                                'error' => "Éxito",
                                'respuesta' => "Camionero guardado"
                            ];
                            $instruccion = "insert into camionero(cedula, nombre_completo, mail, telefono) value ('$cedula[$i]', '$nombre_completo[$i]', '$mail[$i]', '$telefono[$i]')";
                            $conexion->query($instruccion);

                        } else {
                            $respuesta = [
                                'error' => "Error",
                                'respuesta' => "El nombre debe tener solo letras"
                            ];
                        }
                    } else {
                        $respuesta = [
                            'error' => "Error",
                            'respuesta' => "El teléfono no es válido"
                        ];
                    }



                } else {
                    $respuesta = [
                        'error' => "Éxito",
                        'respuesta' => "La cédula debe tener solo números"
                    ];
                }

            } else {
                $respuesta = [
                    'error' => "Éxito",
                    'respuesta' => "Palabras inválidas"
                ];
            }

        } else {
            $respuesta = [
                'error' => "Error",
                'respuesta' => "Campos sin completar"
            ];
        }
    }
    $respuesta = json_encode($respuesta);
    header('Location: alta-camionero.php?datos=' . urlencode($respuesta));
}
?>

<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>

<script src="../js/ocultar-get-alta.js"></script>
<script src="../js/mostrar-respuesta.js"></script>