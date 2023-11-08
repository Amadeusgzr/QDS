<?php
session_start();
// Conexión a la base de datos (reemplaza con tus propios datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qds";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_POST) {
    $estado = $_POST["estado"];
    $nom_usu = $_SESSION["nom_usu"];
    if ($estado == "Historial") {
        $instruccion = "SELECT * FROM solicitud WHERE usuario_destino = '$nom_usu'";
        $solicitudes = [];
        $result = mysqli_query($conn, $instruccion);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($solicitudes, $row);
        }
        foreach ($solicitudes as $solicitud) {
            $id_solicitud = $solicitud["id_solicitud"];
            $instruccion = "SELECT * FROM solicitud WHERE id_solicitud='$id_solicitud'";
            $resultado = mysqli_query($conn, $instruccion);
            $fila =  mysqli_fetch_assoc($resultado);
            if ($fila["estado"] == "En espera") {
                echo "La solicitud $id_solicitud está en espera...";
                echo "<br>";
            } else if ($fila["estado"] == "Aceptada") {
                echo "La solicitud $id_solicitud ha sido aceptada";
                echo "<br>";
            } else if ($fila["estado"] == "Denegada") {
                echo "La solicitud $id_solicitud ha sido denegada";
                echo "<br>";
            }
        }
    } else {
        $instruccion = "SELECT * FROM solicitud WHERE estado='$estado' AND usuario_destino = '$nom_usu'";
        $solicitudes = [];
        $result = mysqli_query($conn, $instruccion);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($solicitudes, $row);
        }

        if ($estado == "Aceptada") {
            foreach ($solicitudes as $solicitud) {
                $id_solicitud = $solicitud["id_solicitud"];
                echo "<hr><p class='p-solicitud'>La solicitud $id_solicitud ha sido aceptada</p> <button class='boton-denegar'>Denegar</button>";
            }
        } else if ($estado == "Denegada") {

            foreach ($solicitudes as $solicitud) {
                $id_solicitud = $solicitud["id_solicitud"];
                echo "La solicitud $id_solicitud ha sido denegada";
                echo "<br>";
            }
        } else if ($estado == "En espera") {
            foreach ($solicitudes as $solicitud) {
                $id_solicitud = $solicitud["id_solicitud"];
                $camionero = $solicitud["usuario"];
                echo "La solicitud $id_solicitud está en espera, solicitud enviada por $camionero...";
                echo "<br>";
            }
        }
    }
}
// Cierra la conexión a la base de datos
$conn->close();
