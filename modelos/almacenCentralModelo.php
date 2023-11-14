<?php

class almacenCentralModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerAlmacenesCentrales($id_almacen_central = null)
    {
        $where = ($id_almacen_central == null) ? "" : " WHERE id_almacen_central='$id_almacen_central'";
        $almacenesCentrales = [];
        $instruccion = "SELECT * FROM almacen_central" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($almacenesCentrales, $row);
        }
        return $almacenesCentrales;
    }
}
?>