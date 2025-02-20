<?php

class solicitudModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }
    public function obtenerSolicitud($id_camioneta, $id_almacen_cliente, $fecha_recogida_ideal, $usuario)
    {
        $solicitud = [];
        $instruccion = "SELECT * FROM solicitud WHERE id_almacen_cliente = $id_almacen_cliente AND usuario = '$usuario' AND fecha_recogida_ideal = '$fecha_recogida_ideal'";
        $resultado = mysqli_query($this->db, $instruccion);
        while ($row = mysqli_fetch_assoc($resultado)) {
            array_push($solicitud, $row);
        }
        return $solicitud;
    }

    public function obtenerSolicitudes($estado, $nom_usu)
    {

        if ($estado == "Historial") {
            $instruccion = "SELECT * FROM solicitud WHERE usuario_destino = '$nom_usu'";
            $solicitudes = [];
            $result = mysqli_query($this->db, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($solicitudes, $row);
            }
        } else{
            $instruccion = "SELECT * FROM solicitud WHERE estado = '$estado' AND usuario_destino = '$nom_usu'";
            $solicitudes = [];
            $result = mysqli_query($this->db, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($solicitudes, $row);
            }
        }
        return $solicitudes;
    }

    public function modificarSolicitud($id_solicitud, $accion)
    {
        if($accion == "a"){
            $instruccion = "UPDATE solicitud SET estado = 'Aceptada' WHERE id_solicitud = $id_solicitud";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Solicitud aceptada"
            ];
            $instruccion = "SELECT * FROM solicitud WHERE id_solicitud = $id_solicitud";            
            $solicitudes = [];
            $result = mysqli_query($this->db, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($solicitudes, $row);
            }
            foreach ($solicitudes as $solicitud){
                $fecha_recogida_ideal = $solicitud["fecha_recogida_ideal"];
                $id_almacen_cliente = $solicitud["id_almacen_cliente"];

                date_default_timezone_set('America/Montevideo');
                $fecha_hora_actual = time();

                $fecha_hora_actual = date('Y-m-d H:i:s', $fecha_hora_actual);


                $instruccion = "UPDATE recoge SET fecha_recogida='$fecha_hora_actual' WHERE fecha_recogida_ideal='$fecha_recogida_ideal' AND id_almacen_cliente='$id_almacen_cliente'";
                mysqli_query($this->db, $instruccion);

            }

        } else if ($accion == "d"){
            $instruccion = "UPDATE solicitud SET estado = 'Denegada' WHERE id_solicitud = $id_solicitud";
            mysqli_query($this->db, $instruccion);
            $resultado = [
                'error' => "Éxito",
                'respuesta' => "Solicitud denegada"
            ];
            $instruccion = "SELECT * FROM solicitud WHERE id_solicitud = $id_solicitud";            
            $solicitudes = [];
            $result = mysqli_query($this->db, $instruccion);
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($solicitudes, $row);
            }
            foreach ($solicitudes as $solicitud){
                $fecha_recogida_ideal = $solicitud["fecha_recogida_ideal"];
                $id_almacen_cliente = $solicitud["id_almacen_cliente"];


                $instruccion = "UPDATE recoge SET fecha_recogida=NULL WHERE fecha_recogida_ideal='$fecha_recogida_ideal' AND id_almacen_cliente='$id_almacen_cliente'";
                mysqli_query($this->db, $instruccion);
                
            }
        }  else {
            $resultado = [
                'error' => "Error",
                'respuesta' => "Acción inválida"
            ];
        }
        return $resultado;
    }

    public function guardarSolicitud($id_camioneta, $id_almacen_cliente, $fecha_recogida_ideal, $usuario)
    {   

        
        $instruccion = "SELECT * FROM almacen_cliente INNER JOIN tiene ON almacen_cliente.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON empresa_cliente.id_empresa_cliente = tiene.id_empresa_cliente WHERE tiene.id_almacen_cliente = $id_almacen_cliente";
        $resultado = mysqli_query($this->db, $instruccion);
        $fila =  mysqli_fetch_assoc($resultado);    
        $empresa = $fila["nombre_de_empresa"];
        date_default_timezone_set('America/Montevideo');

        $fechaHoraActualUruguay = time();

        $fechaHoraActualMySQL = date('Y-m-d H:i:s', $fechaHoraActualUruguay);


        $instruccion= "INSERT INTO solicitud (usuario, usuario_destino, detalles, estado, id_almacen_cliente, fecha_recogida_ideal, fecha_solicitud) VALUES ('$usuario', '$empresa', 'El camionero $usuario llego a su almacén', 'En espera', '$id_almacen_cliente', '$fecha_recogida_ideal',  '$fechaHoraActualMySQL')";
        mysqli_query($this->db, $instruccion);

        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Solicitud enviada"
        ];        
        return $resultado;
    }

    public function modificarEstadoSolicitud($id_camioneta, $id_almacen_cliente, $fecha_recogida_ideal, $usuario)
    {
        date_default_timezone_set('America/Montevideo');

        $fechaHoraActualUruguay = time();

        $fechaHoraActualMySQL = date('Y-m-d H:i:s', $fechaHoraActualUruguay);
        $instruccion = "UPDATE solicitud SET estado = 'En espera', fecha_solicitud = '$fechaHoraActualMySQL' WHERE fecha_recogida_ideal = '$fecha_recogida_ideal' AND id_almacen_cliente = '$id_almacen_cliente'";
        mysqli_query($this->db, $instruccion);
        $resultado = [
            'error' => "Éxito",
            'respuesta' => "Solicitud reenviada"
        ];
        return $resultado;

    }
}