<?php

class loteCamionModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function obtenerCamionPorId($id_camion)
    {
        $lote = [];
        $instruccion = "SELECT * FROM mostrar_lotes WHERE id_camion='$id_camion';";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lote, $row);
        }
        return $lote;
    }



    public function guardarLoteCamion($id_lote, $id_camion)
    {
        $instruccion = "INSERT INTO transporta (id_lote,id_camion) VALUES ('$id_lote','$id_camion')";
        mysqli_query($this->db, $instruccion);

        $instruccion = "UPDATE lote SET estado='En camión (plataforma)' WHERE id_lote ='$id_lote'";
        mysqli_query($this->db, $instruccion);

        $instruccion = "SELECT * FROM forma WHERE id_lote = $id_lote";
        $resultado = mysqli_query($this->db, $instruccion);
        $paquetes = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        foreach ($paquetes as $paquete){
            $id_paquete = $paquete["id_paquete"];
            $instruccion = "UPDATE paquete SET estado ='En camión (plataforma)' WHERE id_paquete = $id_paquete";
            mysqli_query($this->db, $instruccion);
        }

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Lote " . $id_lote . " asignado correctamente al camión " . $id_camion,
        ];
        return $resultado;
    }

    public function eliminarPaqueteLote($id_camion, $id_lote)
    {
        $instruccion = "DELETE FROM transporta WHERE id_lote='$id_lote'";
        mysqli_query($this->db, $instruccion);

        $instruccion = "UPDATE lote SET estado='En almacén central' WHERE id_lote ='$id_lote'";
        mysqli_query($this->db, $instruccion);

        $instruccion = "SELECT * FROM forma WHERE id_lote = $id_lote";
        $resultado = mysqli_query($this->db, $instruccion);
        $paquetes = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        foreach ($paquetes as $paquete){
            $id_paquete = $paquete["id_paquete"];
            $instruccion = "UPDATE paquete SET estado ='En almacén central (lote)' WHERE id_paquete = $id_paquete";
            mysqli_query($this->db, $instruccion);
        }

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete desasignado",
        ];
        return $resultado;
    }

}
