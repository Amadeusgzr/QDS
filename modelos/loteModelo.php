<?php

class loteModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerLote($id_lote)
    {
        $lote = [];
        $instruccion = "SELECT * FROM mostrar_lotes WHERE id_lote='$id_lote'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lote, $row);
        }
        return $lote;
    }
    public function obtenerLotes($id_lote = null)
    {
        $where = ($id_lote == null) ? "" : " WHERE id_lote='$id_lote'";
        $lotes = [];
        $instruccion = "SELECT * FROM mostrar_lotes" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($lotes, $row);
        }
        return $lotes;
    }


    public function guardarLote($fragil, $tipo, $detalles, $id_almacen_central, $id_destino)
    {
        $instruccion = "INSERT INTO lote (fragil,tipo,detalles,id_destino) VALUES ('$fragil','$tipo','$detalles','$id_destino')";
        mysqli_query($this->db, $instruccion);

        $id_lote = mysqli_insert_id($this->db);

        $instruccion = "INSERT INTO almacena1 (id_lote,id_almacen_central) VALUES ('$id_lote','$id_almacen_central')";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'id_lote' => "$id_lote",
            'error' => "Éxito",
            'respuesta' => "Lote guardado",
        ];
        return $resultado;
    }
    public function modificarLote($id_lote, $fragil)
    {
        $validar = $this->obtenerLotes($id_lote);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_lote
        ];
        if (count($validar) > 0) {
            $instruccion = "UPDATE lote SET fragil='$fragil' WHERE id_lote='$id_lote'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Lote modificado"
            ];
        }
        return $resultado;
    }

    public function  modificarEstadoLote($id_lote)
    {
        $validar = $this->obtenerLotes($id_lote);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_lote
        ];
        if (count($validar) > 0) {
            $instruccion = "SELECT estado FROM lote WHERE id_lote='$id_lote'";
            $resultado = mysqli_query($this->db, $instruccion);
            $fila =  mysqli_fetch_assoc($resultado);
            $estado = $fila["estado"];
            if ($estado == "En camión (plataforma)" || $estado == "Entregado"){
                if ($estado == "En camión (plataforma)"){
                    $instruccion = "UPDATE lote SET estado='Entregado' WHERE id_lote = '$id_lote'";
                    mysqli_query($this->db, $instruccion);     
                    $paquetes = [];
                    $instruccion = "SELECT * FROM forma WHERE id_lote = $id_lote";
                    $resultado = mysqli_query($this->db, $instruccion);
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push($paquetes, $row);
                    }
                    foreach ($paquetes as $paquete){
                        $id_paquete = $paquete["id_paquete"];
                        date_default_timezone_set('America/Montevideo');

                        $fechaHoraActualUruguay = time();

                        $fechaHoraActualMySQL = date('Y-m-d H:i:s', $fechaHoraActualUruguay);

                        $instruccion = "UPDATE paquete SET estado ='Entregado', fecha_recibido = '$fechaHoraActualMySQL' WHERE id_paquete = $id_paquete";
                        mysqli_query($this->db, $instruccion);
                    }
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete entregado"
                    ];
                } else {
                    $instruccion = "UPDATE lote SET estado='En camión (plataforma)' WHERE id_lote = '$id_lote'";
                    mysqli_query($this->db, $instruccion);
                    $instruccion = "SELECT * FROM forma WHERE id_lote = $id_lote";
                    $resultado = mysqli_query($this->db, $instruccion);
                    $paquetes = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push($paquetes, $row);
                    }
                    foreach ($paquetes as $paquete){
                        $id_paquete = $paquete["id_paquete"];
                        $instruccion = "UPDATE paquete SET estado ='En camión (plataforma)',  fecha_recibido = NULL WHERE id_paquete = $id_paquete";
                        mysqli_query($this->db, $instruccion);
                    }
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete desentregado"
                    ];          
                }
            } else {
                $resultado = [
                    'error' => "Error",
                    'respuesta' => "No tienes permisos para hacer esto"
                ]; 
            }
        }
        return $resultado;
    }

    public function eliminarLote($id_lote)
    {
        $validar = $this->obtenerLotes($id_lote);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_lote
        ];
        if (count($validar) > 0) {
            $instruccion = "DELETE FROM almacena1 WHERE id_lote='$id_lote'";
            mysqli_query($this->db, $instruccion);

            $instruccion = "DELETE FROM lote WHERE id_lote='$id_lote'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Lote eliminado"
            ];
        }

        return $resultado;
    }



}
?>