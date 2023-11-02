<?php

class plataformaModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerPlataformas($id_plataforma = null)
    {
        $where = ($id_plataforma == null) ? "" : " WHERE id_plataforma='$id_plataforma'";
        $plataformas = [];
        $instruccion = "SELECT * FROM plataforma INNER JOIN destino_paquete ON plataforma.departamento = destino_paquete.id_destino" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($plataformas, $row);
        }
        return $plataformas;
    }
}
?>