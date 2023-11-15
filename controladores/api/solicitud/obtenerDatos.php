<?php
session_start();
$ch = curl_init();

$estado = $_POST["estado"];
$nom_usu = $_SESSION["nom_usu"];

$array = [
    'estado' => "$estado",
    "nom_usu" => "$nom_usu"
];


$datos = json_encode($array);

curl_setopt($ch, CURLOPT_URL, 'localhost/QDS/controladores/solicitudControlador.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec($ch);

if (curl_errno($ch)) {
    echo curl_errno($ch);
} else {
    $decode = json_decode($respuesta, true);
}

curl_close($ch);
if ($estado == "Historial") {
    foreach ($decode as $solicitud) {
        $id_solicitud = $solicitud["id_solicitud"];
        $camionero = $solicitud["usuario"];
        if ($solicitud["estado"] == "Aceptada") {
            echo "<hr>
            <div class='div-solicitud'>
                <div class='solicitud-info'>
                    <img src='../img/iconos/icono-usuario.png' alt='>
                    <p class='nombre-solicitud'>$camionero</p>
                </div>
                <p class='mensaje-solicitud mensaje-historial'>La solicitud $id_solicitud ha sido aceptada</p>
                <div class='solicitud-info'>
                    <span>9/11/2023</span>
                    <input type='text' hidden>
                </div>
            </div>";
        } else if ($solicitud["estado"] == "Denegada") {
            echo "<hr>
            <div class='div-solicitud'>
                <div class='solicitud-info'>
                    <img src='../img/iconos/icono-usuario.png' alt='>
                    <p class='nombre-solicitud'>$camionero</p>
                </div>
                <p class='mensaje-solicitud'>La solicitud $id_solicitud ha sido denegada</p>
                <div class='solicitud-info'>
                    <span>9/11/2023</span>
                    <input type='text' hidden>
                </div>
            </div>";
        }
    }
} else {
    if ($estado == "Aceptada") {
        foreach ($decode as $solicitud) {
            $id_solicitud = $solicitud["id_solicitud"];
            $camionero = $solicitud["usuario"];
            echo "<hr>
            <div class='div-solicitud'>
                <div class='solicitud-info'>
                    <img src='../img/iconos/icono-usuario.png' alt='>
                    <p class='nombre-solicitud'>$camionero</p>
                </div>
                <p class='mensaje-solicitud'>La solicitud $id_solicitud ha sido aceptada
                </p>
                <div class='solicitud-info'>
                    <span>9/11/2023</span>
                    <input type='text' hidden>
                    <a href='../../controladores/api/solicitud/modificarDato.php?id_solicitud=$id_solicitud&a=d'><button
                            class='estilo-boton2 boton-volver'>Denegar</button></a>
                </div>
            </div>";
        }
    } else if ($estado == "Denegada") {

        foreach ($decode as $solicitud) {
            $id_solicitud = $solicitud["id_solicitud"];
            $camionero = $solicitud["usuario"];
            echo "<hr>
            <div class='div-solicitud'>
                <div class='solicitud-info'>
                    <img src='../img/iconos/icono-usuario.png' alt='>
                    <p class='nombre-solicitud'>$camionero</p>
                </div>
                <p class='mensaje-solicitud'>La solicitud $id_solicitud ha sido denegada</p>
                <div class='solicitud-info'>
                    <span>9/11/2023</span>
                    <input type='text' hidden>
                </div>
            </div>";
        }
    } else if ($estado == "En espera") {
        foreach ($decode as $solicitud) {
            $id_solicitud = $solicitud["id_solicitud"];
            $camionero = $solicitud["usuario"];
            $id_almacen_cliente = $solicitud["id_almacen_cliente"];
            ?>
                    <hr>
                    <div class="div-solicitud">
                        <div class="solicitud-info">
                            <img src="../img/iconos/icono-usuario.png" alt="">
                            <p class="nombre-solicitud">
                        <?= $camionero ?>
                            </p>
                        </div>
                        <p class="mensaje-solicitud mensaje-espera">Solicitud para retirar paquetes del almacén
                    <?= $id_almacen_cliente ?>
                        </p>
                        <div class="solicitud-info">
                            <span>9/11/2023</span>
                            <input type="text" hidden>
                            <a href="../../controladores/api/solicitud/modificarDato.php?id_solicitud=<?= $id_solicitud ?>&a=a"><button
                                    class="estilo-boton2 boton-siguiente">Aceptar</button></a>
                            <a href="../../controladores/api/solicitud/modificarDato.php?id_solicitud=<?= $id_solicitud ?>&a=d"><button
                                    class="estilo-boton2 boton-volver boton-denegar2">Denegar</button></a>
                        </div>
                    </div>

            <?php
        }
    }
}