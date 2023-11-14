<?php

class paqueteLoteModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerLotePorId($id_lote)
    {
        $lote = [];
        $instruccion = "SELECT * FROM forma INNER JOIN paquete ON forma.id_paquete = paquete.id_paquete WHERE id_lote='$id_lote';        ";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lote, $row);
        }
        return $lote;
    }



    public function guardarPaqueteLote($id_paquete, $id_lote)
    {
        $instruccion = "INSERT INTO forma (id_paquete,id_lote) VALUES ('$id_paquete','$id_lote')";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete " . $id_paquete . " asignado correctamente al lote " . $id_lote,
        ];
        return $resultado;
    }

    public function eliminarPaqueteLote($id_paquete, $id_lote)
    {
        $instruccion = "DELETE FROM forma WHERE id_paquete='$id_paquete'";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete desasignado",
        ];
        return $resultado;
    }

}

?>