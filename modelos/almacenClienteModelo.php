<?php

class almacenClienteModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerAlmacenesClientes($id_almacen_cliente = null)
    {
        $where = ($id_almacen_cliente == null) ? "" : " WHERE id_almacen_cliente='$id_almacen_cliente'";
        $almacenes_cliente = [];
        $instruccion = "SELECT * FROM almacen_cliente INNER JOIN tiene ON almacen_cliente.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE almacen_cliente.estado != 'De baja'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($almacenes_cliente, $row);
        }
        return $almacenes_cliente;
    }
    public function obtenerAlmacenClientePorEmpresa($empresa)
    {
        $almacen_cliente = [];
        $instruccion = "SELECT * FROM almacen_cliente INNER JOIN tiene ON almacen_cliente.id_almacen_cliente=tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente=empresa_cliente.id_empresa_cliente WHERE nombre_de_empresa='$empresa' AND almacen_cliente.estado != 'De baja'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($almacen_cliente, $row);
        }
        return $almacen_cliente;
    }
}