<?php
header("Location: ../vistas/permisos.php");

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
        if(count($paquete) < 1){
            $paquete = [
                'error' => "Éxito",
                'respuesta' => "Paquete guardado"
            ];
        }
         return $paquete;
        

       
    }
    public function obtenerPaquetePorEmpresa($empresa)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM paquete WHERE empresa='$empresa'";
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
        $instruccion = "SELECT * FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino" . $where;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        return $paquetes;
    }


    public function guardarPaquete($mail_destinatario, $direccion, $peso, $volumen, $fragil, $tipo, $detalles, $codigo, $empresa)
    {


        $instruccion = "INSERT INTO paquete (mail_destinatario,direccion,peso,volumen,fragil,tipo,detalles,codigo_seguimiento,Empresa) VALUES ('$mail_destinatario','$direccion','$peso','$volumen','$fragil','$tipo','$detalles','$codigo','$empresa')";
        mysqli_query($this->db, $instruccion);
        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Paquete guardado"
        ];
        return $resultado;


    }
    public function modificarPaquete($id_paquete, $direccion, $peso, $volumen, $fragil, $estado, $empresa, $tipo_usu)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            if ($tipo_usu !== "empresa"){
            $instruccion = "UPDATE paquete SET direccion='$direccion', peso='$peso', volumen='$volumen', fragil='$fragil', estado='$estado' WHERE id_paquete='$id_paquete'";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete modificado"
            ];
            } else {
                $instruccion = "SELECT empresa, estado FROM paquete WHERE id_paquete='$id_paquete'";
                $resultado = mysqli_query($this->db, $instruccion);
                $fila =  mysqli_fetch_assoc($resultado);
                $empresa1 = $fila["empresa"];
                $estado = $fila["estado"];
                if ($estado == "En almacén cliente"){
                                    if ($empresa == $empresa1){
                    $instruccion = "UPDATE paquete SET direccion='$direccion', peso='$peso', volumen='$volumen', fragil='$fragil', estado='$estado' WHERE id_paquete='$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete modificado"
                    ];
                } else {
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "Este paquete no es de tu pertenencia"
                    ];
                }
                } else{
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "No tienes permiso para hacer esto"
                    ];
                }

 
            }

        }
        return $resultado;
    }

    public function modificarEstadoPaquete($id_paquete)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            $instruccion = "SELECT estado FROM paquete WHERE id_paquete='$id_paquete'";
            $resultado = mysqli_query($this->db, $instruccion);
            $fila =  mysqli_fetch_assoc($resultado);
            $estado = $fila["estado"];
            if ($estado == "En almacén cliente" || $estado == "En camión (central)"){
                if ($estado == "En almacén cliente"){
                    $instruccion = "UPDATE paquete SET estado='En camión (central)' WHERE id_paquete = '$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete recogido"
                    ];     
                } else {
                    $instruccion = "UPDATE paquete SET estado='En almacén cliente' WHERE id_paquete = '$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete desrecogido"
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
    public function eliminarPaquete($id_paquete, $empresa, $tipo_usu)
    {
        $validar = $this->obtenerPaquetes($id_paquete);
        $resultado = [
            'error' => "Error",
            'respuesta' => "No existe el paquete con la ID " . $id_paquete
        ];
        if (count($validar) > 0) {
            if ($tipo_usu !== "empresa"){
                $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
                mysqli_query($this->db, $instruccion);
                $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete eliminado"
            ];
            } else {
                $instruccion = "SELECT empresa FROM paquete WHERE id_paquete='$id_paquete'";
                $resultado = mysqli_query($this->db, $instruccion);
                $fila = mysqli_fetch_assoc($resultado);
                $empresa1 = $fila["empresa"];
                if ($empresa == $empresa1){
                    $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
                    mysqli_query($this->db, $instruccion);
                    $resultado = [
                        'error' => "Éxito",
                        'respuesta' => "Paquete eliminado"
                    ];
                } else {
                    $resultado = [
                        'error' => "Error",
                        'respuesta' => "Este paquete no es de tu pertenencia"
                    ];
                }
 
            }

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