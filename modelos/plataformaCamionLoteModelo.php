<?php

class plataformaCamionLoteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerPlataformaCamionLote ($id_lote)
    {
        $lote = [];
        $instruccion = "SELECT * FROM lleva INNER JOIN transporta ON lleva.id_lote = transporta.id_lote WHERE lleva.id_lote='$id_lote'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lote, $row);
        }
        
        return $lote;
    }


    public function guardarPlataformaCamionLote($id_lote, $id_plataforma, $id_camion)
    {
        $instruccion = "INSERT INTO transporta (id_lote,id_camion) VALUES ('$id_lote','$id_camion')";
        mysqli_query($this->db, $instruccion);

        $instruccion = "INSERT INTO lleva (id_lote,id_plataforma) VALUES ('$id_lote','$id_plataforma')";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Lote " . $id_lote . " asignado correctamente"
        ];
        return $resultado;
    }
}
