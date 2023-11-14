<?php

class destinoModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerDestinos($id_destino = null)
    {
        $where = ($id_destino == null) ? "" : " WHERE id_destino='$id_destino'";
        $destinos = [];
        $instruccion = "SELECT * FROM destino" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($destinos, $row);
        }
        return $destinos;
    }
}
?>