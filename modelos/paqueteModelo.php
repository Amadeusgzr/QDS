<?php

class paqueteModelo
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'QDS');
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerPaquetePorCodigo($codigo)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM paquete WHERE codigo_seguimiento='$codigo'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        return $paquete;
    }
    public function obtenerPaquete($id_paquete)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM paquete WHERE id_paquete='$id_paquete'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        return $paquete;
    }
    public function obtenerPaquetes($id_paquete = null)
    {
        $where = ($id_paquete == null) ? "" : " WHERE id_paquete='$id_paquete'";
        $paquetes = [];
        $instruccion = "SELECT * FROM paquete" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        return $paquetes;
    }


    public function guardarPaquete($mail_destinatario, $direccion, $peso, $volumen, $fragil, $tipo, $detalles, $codigo)
    {


        $instruccion = "INSERT INTO paquete (mail_destinatario,direccion,peso,volumen,fragil,tipo,detalles,codigo_seguimiento) VALUES ('$mail_destinatario','$direccion','$peso','$volumen','$fragil','$tipo','$detalles','$codigo')";
        mysqli_query($this->db, $instruccion);
        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete guardado"
        ];
        return $resultado;


    }
    public function modificarPaquete($id_paquete, $direccion, $peso, $volumen, $fragil, $estado)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            $instruccion = "UPDATE paquete SET direccion='$direccion', peso='$peso', volumen='$volumen', fragil='$fragil', estado='$estado' WHERE id_paquete='$id_paquete'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete modificado"
            ];
        }
        return $resultado;
    }

    public function eliminarPaquete($id_paquete)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete eliminado"
            ];
        }

        return $resultado;
    }

    public function validatePackage($name, $description)
    {
        $packages = [];
        $query = "SELECT * FROM packages WHERE name='$name' AND description='$description'";
        $result = mysqli_query($this->db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($packages, $row);
        }
        return $packages;
    }



}
?>