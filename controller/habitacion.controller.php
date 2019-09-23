<?php 
require_once "controller/tiempo.controller.php";
Class HabitacionController{
    private  $masterModel;
    private $doizer;
    private $tiempoController;
    function HabitacionController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
        $this->tiempoController = new TiempoController($masterModel,$doizer);
    }

    function createRoom(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si el tipo de habitacion  existe
            $numeroHabitacion = $this->newNumberOfRoom(true);
            if(!empty($numeroHabitacion)){
                $request["hab_fecha_creacion"] = date("Y-m-d");
                $request["hab_estado"] = 1;
                $request["estado_reserva"] = 1;
                $existe_tipo = $this->masterModel->sqlSelect("SELECT id_tipo_habitacion FROM tipo_habitacion WHERE id_tipo_habitacion = ? ",array($request["tipo_habitacion"]));
                if(!empty($existe_tipo)){
                    $insert = $this->masterModel->insert("habitacion",array($numeroHabitacion,$request["tipo_habitacion"],$request["detalles"],$request["estado_reserva"],$request["hab_fecha_creacion"],$request["hab_estado"]),array(""));
                    if($insert){
                        $status = "success";
                        $numHabitacion = $numeroHabitacion;
                        $message = "Habitación registrada exitosamente.";
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $numHabitacion = null;
                        $message = "error guardando en base de datos.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $numHabitacion = null;
                    $message = "Ingresa un tipo de habitación Válido.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $numHabitacion = null;
                $message = "No ha sido posible obtener el tipo de habitación,Intentalo de nuevo.";
            }
            $result = array("status"=>$status,"numero_habitacion"=>$numHabitacion,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UpdateRoom(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si la habitacion  existe
            $existeHabitacion = $this->masterModel->sqlSelect("SELECT hab_numero FROM habitacion WHERE hab_numero = ? ",array($request["id"]));
            if(!empty($existeHabitacion)){
                $existeTipo = $this->masterModel->sqlSelect("SELECT id_tipo_habitacion FROM tipo_habitacion WHERE id_tipo_habitacion = ? ",array($request["tipo_habitacion"]));
                //saber si el estado es valido
                if(!empty($existeTipo)){
                    if($request["estado"]==0 || $request["estado"]==1){
                        $insert = $this->masterModel->sql("UPDATE habitacion SET  id_tipo_habitacion = ?, hab_detalle = ?,hab_estado = ? WHERE hab_numero = ? ",array($request["tipo_habitacion"],$request["hab_detalle"],$request["estado"],$request["id"]));
                        if($insert){
                            $status = "success";
                            $message = "Habitación modificada exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Error al realizar la modificación.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por ingresa un estado válido.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Este tipo de habitación no esta Registrada en el sistema.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Esta Habitación no esta registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function deleteRoom(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar la habitacion
            $existeHabitacion = $this->masterModel->sqlSelect("SELECT hab_numero FROM habitacion WHERE hab_numero = ? ",array($request["id"]));
            if(!empty($existeHabitacion)){
                $eliminar = $this->masterModel->sql("UPDATE habitacion SET hab_estado = ? WHERE hab_numero = ?",array(0,$_POST["id"]));
                if($eliminar){
                    $status = "success";
                    $message = "Habitacióm eliminada.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error en base de datos.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Esta habitación no esta  registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readByRoom(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT h.hab_numero,h.hab_detalle,sr.sr_estado_reserva,h.hab_estado,th.th_nombre_tipo,th.th_valor_hora,th.th_valor_persona_adicional,sr.sr_nombre,sr.sr_color FROM habitacion  h INNER JOIN  tipo_habitacion th ON h.id_tipo_habitacion = th.id_tipo_habitacion INNER JOIN estado_reserva sr ON sr.sr_estado_reserva = h.sr_estado_reserva WHERE ".$request['columnDBSearch']." = ? AND h.hab_estado = ? ORDER BY h.hab_numero ASC ",array($request["value"],1));
            if(!empty($dataType)){
                $status = "success";
                $message = "Consultas realizada.";
                foreach($dataType as $row){
                    //si tiene una reserva activa
                    $datosReserva = $this->masterModel->selectBy("reserva_activa",array("hab_numero",$row->hab_numero));
                    if( $row->sr_estado_reserva!=1 && !empty($datosReserva)){
                        if($datosReserva->ra_inicio_tiempo_parcial==null){
                            $row->tiempo_transcurido=$this->tiempoController->tiempoTranscurridoFechas($datosReserva->ra_fecha_hora_ingreso,date('Y-m-d H:i:s'));
                        }else{
                            //validar el tiempo parcial
                            if($datosReserva->ra_fin_tiempo_parcial==null){
                                $row->tiempo_transcurido=$this->tiempoController->tiempoTranscurridoFechas($datosReserva->ra_fecha_hora_ingreso,$datosReserva->ra_inicio_tiempo_parcial);
                            }else{
                                $tiempo_transcurido = date("Y-m-d")." ".$this->tiempoController->tiempoTranscurridoFechas($datosReserva->ra_fecha_hora_ingreso,date('Y-m-d H:i:s'));
                                $row->tiempo_transcurido=$this->tiempoController->restarTiempoParcial($datosReserva->ra_inicio_tiempo_parcial,$datosReserva->ra_fin_tiempo_parcial,$tiempo_transcurido);
                            }
                        }
                    }
                }
                $data = $dataType;
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "no hay información asociada a esta consulta verifica los parametros.";
                $data = null;
            }
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    function readByRoomCant(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->sqlSelect("SELECT COUNT(*) AS cantidad FROM habitacion ",array(""))[0];
        if(!empty($dataType)){
            $status = "success";
            $message = "Consultas realizada.";
            $data = $dataType;
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
        }
        $result = array("status"=>$status,"message"=>$message,"data"=>$data);
        echo json_encode($result);
    }

    function newNumberOfRoom($return = false){
        header('Content-Type:application/json');
        $numeroHabitacion = $this->masterModel->sqlSelect("SELECT MAX(hab_numero) as numero_actual FROM habitacion",array())[0];
        if(!empty($numeroHabitacion)){
            $status = "success";
            $message = "Consultas realizada.";
            $data = $numeroHabitacion->numero_actual+1;
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
        }
        $result = array("status"=>$status,"message"=>$message,"numero_nueva_habitacion"=>$data);
        if($return){
            return $data;
        }else{
            echo json_encode($result);
        }
    }

    
}

?>