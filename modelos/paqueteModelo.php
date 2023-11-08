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
        $paquete1 = [];
        $instruccion = "SELECT * FROM paquete INNER JOIN almacena ON almacena.id_paquete = paquete.id_paquete INNER JOIN recoge ON recoge.id_almacen_cliente = almacena.id_almacen_cliente WHERE paquete.id_paquete='$id_paquete'";
        $resultado = mysqli_query($this->db, $instruccion);    
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete1, $row);
        }

        if (count($paquete1) > 0){
            $paquete = [];
            $instruccion = "SELECT *, paquete.estado AS paquete_estado FROM paquete INNER JOIN destino ON paquete.id_destino = destino.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente INNER JOIN recoge ON almacena.id_almacen_cliente = recoge.id_almacen_cliente INNER JOIN camioneta ON recoge.id_camioneta = camioneta.id_camioneta INNER JOIN vehiculo ON camioneta.id_camioneta = vehiculo.id_vehiculo WHERE paquete.id_paquete='$id_paquete' AND recoge.fecha_recogida IS NULL AND recoge.hora_recogida IS NULL ORDER BY fecha_recogida_ideal DESC, hora_recogida_ideal DESC";
            $resultado = mysqli_query($this->db, $instruccion);    
            while ($row = mysqli_fetch_assoc($resultado)) {
                array_push($paquete, $row);
            }
        } else {
            $paquete = [];
            $instruccion = "SELECT *, paquete.estado AS paquete_estado FROM paquete INNER JOIN destino ON paquete.id_destino = destino.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE paquete.id_paquete='$id_paquete'";
            $resultado = mysqli_query($this->db, $instruccion);    
            while ($row = mysqli_fetch_assoc($resultado)) {
                array_push($paquete, $row);
            }
        }

         return $paquete;
    }
    public function obtenerPaquetePorEmpresa($empresa)
    {
        $paquete = [];
        $instruccion = "SELECT * FROM mostrar_paquetes_empresa WHERE nombre_de_empresa = '$empresa'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        return $paquete;
    }

    public function obtenerPaquetePorCamioneta($id_camioneta)
    {
        $paquete = [];
        $instruccion = "SELECT DISTINCT paquete.id_paquete, paquete.direccion AS paquete_direccion, paquete.estado AS paquete_estado FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN recoge ON almacena.id_almacen_cliente = recoge.id_almacen_cliente INNER JOIN camioneta ON recoge.id_camioneta = camioneta.id_camioneta WHERE camioneta.id_camioneta = '$id_camioneta';";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquete, $row);
        }
        return $paquete;
    }



    public function buscarPorId($id_paquete, $id_almacen_cliente, $estado)
    {
        $sentencia_paquete = "WHERE paquete.id_paquete=$id_paquete ";
        $sentencia_almacen = "AND almacena.id_almacen_cliente=$id_almacen_cliente ";
        $sentencia_estado = "AND paquete.estado='$estado' ";

        if(!isset($id_almacen_cliente) || is_null($id_almacen_cliente) || empty(trim($id_almacen_cliente))){
            $sentencia_almacen = "";
            if(!isset($id_paquete) || is_null($id_paquete) || empty(trim($id_paquete))){
                $sentencia_paquete = "";
                if(!isset($estado) || is_null($estado) || empty(trim($estado))){
                    $sentencia_estado = "";
                } else {
                    $sentencia_estado = "WHERE estado='$estado' ";
                }
            } else{
                if(!isset($estado) || is_null($estado) || empty(trim($estado))){
                    $sentencia_paquete = "WHERE paquete.id_paquete=$id_paquete ";
                    $sentencia_estado = "";
                } else{
                    $sentencia_paquete = "WHERE paquete.id_paquete=$id_paquete ";
                    $sentencia_estado = "AND paquete.estado='$estado' ";
                }
            }
        } else{
            if(!isset($id_paquete) || is_null($id_paquete) || empty(trim($id_paquete))){
                $sentencia_almacen = "WHERE almacena.id_almacen_cliente=$id_almacen_cliente ";
                $sentencia_paquete = "";
            }
            if(!isset($estado) || is_null($estado) || empty(trim($estado))){
                $sentencia_estado = "";
            }
 
        }
        $paquete = [];
        $instruccion = "SELECT * FROM paquete INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete " . $sentencia_paquete . $sentencia_almacen . $sentencia_estado . "ORDER BY paquete.id_paquete ASC";
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
        $instruccion = "SELECT * FROM paquete INNER JOIN destino ON paquete.id_destino = destino.id_destino" . $where . " ORDER BY paquete.id_paquete ASC" ;
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($paquetes, $row);
        }
        return $paquetes;
    }


    public function guardarPaquete($mail_destinatario, $direccion, $peso, $volumen, $fragil, $tipo, $detalles, $codigo, $id_almacen_cliente, $id_destino, $estado)
    {

        $instruccion = "INSERT INTO paquete (mail_destinatario,direccion,peso,volumen,fragil,tipo,detalles,codigo_seguimiento,id_destino,estado) VALUES ('$mail_destinatario','$direccion','$peso','$volumen','$fragil','$tipo','$detalles','$codigo','$id_destino','$estado')";
        mysqli_query($this->db, $instruccion);

        $id_paquete = mysqli_insert_id($this->db);

        $instruccion = "INSERT INTO almacena (id_almacen_cliente,id_paquete) VALUES ('$id_almacen_cliente','$id_paquete')";
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
                $instruccion = "SELECT empresa_cliente.nombre_de_empresa, paquete.estado FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE paquete.id_paquete='$id_paquete'";
                $resultado = mysqli_query($this->db, $instruccion);
                $fila =  mysqli_fetch_assoc($resultado);
                $empresa1 = $fila["nombre_de_empresa"];
                $estado = $fila["estado"];
                if ($estado == "En almacén cliente"){
                    if ($empresa == $empresa1){
                    $instruccion = "UPDATE paquete SET direccion='$direccion', peso='$peso', volumen='$volumen', fragil='$fragil' WHERE id_paquete='$id_paquete'";
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
            if ($estado == "En almacén cliente" || $estado == "En camioneta (central)"){
                if ($estado == "En almacén cliente"){
                    $instruccion = "UPDATE paquete SET estado='En camioneta (central)' WHERE id_paquete = '$id_paquete'";
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
                $instruccion = "DELETE FROM almacena WHERE id_paquete='$id_paquete'";
                mysqli_query($this->db, $instruccion);

                $instruccion = "DELETE FROM paquete WHERE id_paquete='$id_paquete'";
                mysqli_query($this->db, $instruccion);
                $resultado = [
                'error' => "Éxito",
                'respuesta' => "Paquete eliminado"
            ];
            } else {
                $instruccion = "SELECT empresa_cliente.nombre_de_empresa, paquete.estado FROM paquete INNER JOIN destino_paquete ON paquete.id_destino = destino_paquete.id_destino INNER JOIN almacena ON paquete.id_paquete = almacena.id_paquete INNER JOIN tiene ON almacena.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON tiene.id_empresa_cliente = empresa_cliente.id_empresa_cliente WHERE paquete.id_paquete='$id_paquete'";
                $resultado = mysqli_query($this->db, $instruccion);
                $fila = mysqli_fetch_assoc($resultado);
                $empresa1 = $fila["nombre_de_empresa"];
                $estado = $fila["estado"];
                if ($estado == "En almacén cliente"){
                    if ($empresa == $empresa1){
                        $instruccion = "DELETE FROM almacena WHERE id_paquete='$id_paquete'";
                        mysqli_query($this->db, $instruccion);

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

}
?>