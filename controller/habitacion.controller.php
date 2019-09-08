<?php 
Class HabitacionController{
    private  $masterModel;
    private $doizer;
    function HabitacionController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
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
                $existe_tipo = $this->masterModel->sqlSelect("SELECT id_tipo_habitacion FROM tipo_habitacion WHERE id_tipo_habitacion = ? ",array($request["tipo_habitacion"]));
                if(!empty($existe_tipo)){
                    $insert = $this->masterModel->insert("habitacion",array($numeroHabitacion,$request["tipo_habitacion"],$request["detalles"],$request["hab_fecha_creacion"],$request["hab_estado"]),array(""));
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
            //validar si el tipo de habitacion  existe
            $existeTipo = $this->masterModel->sqlSelect("SELECT id_habitacion FROM tipo_habitacion WHERE id_habitacion = ? ",array($request["id"]));
            if(!empty($existeTipo)){
                //saber si el estado es valido
                if($request["estado"]==0 || $request["estado"] ==1){
                    if($request["valor_hora"]>0 && $request["valor_persona_adicional"]>0){
                        $insert = $this->masterModel->sql("UPDATE tipo_habitacion SET  th_nombre_tipo = ?, th_descripcion = ?,th_valor_hora = ?, th_valor_persona_adicional = ?, th_estado = ? WHERE id_habitacion = ? ",array($request["nombre_tipo"],$request["descripcion"],$request["valor_hora"],$request["valor_persona_adicional"],$request["estado"],$request["id"]));
                        if($insert){
                            $status = "success";
                            $message = "Tipo de habitación modificada exitosamente.";
                        }else{
                            $status = "error";
                            $message = "El nombre del tipo de habitación ya ha sido registrado.";
                        }
                    }else{
                        $status = "error";
                        $message = "Por favor ingresa un precio válido en  el valor de la hora o persona adicional.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Por favor ingresa un estado válido.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este tipo de habitación no esta registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function deleteTypeRoom(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si el tipo existe
            $existeTipo = $this->masterModel->sqlSelect("SELECT id_habitacion FROM tipo_habitacion WHERE id_habitacion = ?",array($request["id"]));
            if(!empty($existeTipo)){
                $eliminar = $this->masterModel->sql("UPDATE tipo_habitacion SET th_estado = ? WHERE id_habitacion = ?",array(0,$_POST["id"]));
                if($eliminar){
                    $status = "success";
                    $message = "Tipo de usuario eliminado.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error en base de datos.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este tipo de habitación no esta  registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readByTypeRoom(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM tipo_habitacion WHERE ".$request['columnDBSearch']." = ? AND th_estado = ?",array($request["value"],1));
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
        }else{
            header('405 Method Not Allowede', true, 405);
        }
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