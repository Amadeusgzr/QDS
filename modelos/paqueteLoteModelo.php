<?php

class paqueteLoteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }

    public function guardarPaqueteLote($id_paquete, $id_lote)
    {
        $instruccion = "INSERT INTO forma (id_paquete,id_lote) VALUES ('$id_paquete','$id_lote')";
        mysqli_query($this->db, $instruccion);

        $instruccion = "UPDATE paquete SET estado = 'En almacén cliente (Lote)' WHERE id_paquete = $id_paquete";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete " . $id_paquete . " asignado correctamente al lote " . $id_lote,
            'id_lote' => "$id_lote"
        ];
        return $resultado;
    }
}

?>