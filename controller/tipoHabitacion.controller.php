<?php 
Class TipoHabitacionController{
    private  $masterModel;
    private $doizer;
    function TipoHabitacionController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createType(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si el tipo de habitacion  existe
            $existeTipo = $this->masterModel->sqlSelect("SELECT id_habitacion FROM tipo_habitacion WHERE th_nombre_tipo = ? ",array($request["nombre_tipo"]));
            if(empty($existeTipo)){
                if($request["valor_hora"]>0 && $request["valor_persona_adicional"]>0){
                    $request["th_fecha_creacion"] = date("Y-m-d");
                    $request["th_estado"] = 1;
                    $insert = $this->masterModel->insert("tipo_habitacion",array($request["nombre_tipo"],$request["descripcion"],$request["valor_hora"],$request["valor_persona_adicional"],$request["th_estado"],$request["th_fecha_creacion"]),array("id_habitacion"));
                    if($insert){
                        $status = "success";
                        $message = "Tipo de habitación registrado exitosamente.";
                    }else{
                        $status = "error";
                        $message = "error guardando en base de datos.";
                    }
                }else{
                    $status = "error";
                    $message = "Por favor ingresa un precio válido en  el valor de la hora o persona adicional.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este tipo de habitación ya esta registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UpdateTypeRoom(){
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
    
}

?>