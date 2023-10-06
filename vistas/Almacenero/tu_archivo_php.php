<?php
require("../../modelos/db.php");
 $jsonString = $_POST['todo'];
 echo $jsonString;

 $miArray = json_decode($jsonString, true);

 print_r($miArray);

 foreach($miArray as $array){
    echo $array[0] . "</br>";
    $instruccion = "DELETE FROM paquete WHERE id_paquete='$array[0]'";
    $conexion->query($instruccion);
}



?>