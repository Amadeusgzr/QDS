<?php
require("../../modelos/db.php");
$estado = $_POST["estado"];
    $mensajes = [];
    $instruccion = "select * from mensaje";
    $resultado = mysqli_query($conexion, $instruccion);
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($mensajes, $row);
    }

    foreach ($mensajes as $mensaje) {
        
        $id_mensaje = $mensaje["id_mensaje"];
        $estado1 = $mensaje["estado"];
        $nombre_remitente = $mensaje["nombre_remitente"];
        $mensaje1 = $mensaje["mensaje"];
        $fecha_mensaje = $mensaje["fecha_mensaje"];
        $mail_remitente = $mensaje["mail_remitente"];
        
        if ($estado1 == $estado) {
            echo "<hr>
            <div class='div-solicitud'>
                <div class='solicitud-info'>
                    <img src='../img/iconos/icono-usuario.png' alt='>
                    <p class='nombre-solicitud'>$nombre_remitente</p>
                    <p class='nombre-solicitud'>$mail_remitente</p>
                </div>
                <p class='mensaje-solicitud'>$mensaje1</p>
                <div class='solicitud-info'>
                    <span>$fecha_mensaje</span>";

            if ($estado == "Sin responder") {
                echo "<a href='ver-mensajes.php?id_mensaje=$id_mensaje&a=ec'><button
                class='estilo-boton2 boton-siguiente'>En curso</button></a>
                </div>
                </div>";
            } else if ($estado == "En curso"){
                echo "<a href='ver-mensajes.php?id_mensaje=$id_mensaje&a=r'><button
                class='estilo-boton2 boton-siguiente'>Resuelto</button></a>
                </div>
                </div>";
            } else if ($estado == "Resuelto"){
                echo "
                </div>
                </div>";
            }
        } 
    }


