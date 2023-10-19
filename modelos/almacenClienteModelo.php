<?php

class almacenClienteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerAlmacenClientePorEmpresa($empresa)
    {
        $almacen_cliente = [];
        $instruccion = "SELECT * FROM almacen_cliente INNER JOIN tiene ON almacen_cliente.id_almacen_cliente=tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.rut=empresa_cliente.rut WHERE nombre_de_empresa='$empresa'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($almacen_cliente, $row);
        }
        return $almacen_cliente;
    }
}