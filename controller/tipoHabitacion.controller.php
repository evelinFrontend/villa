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
            //validar los precios 
            for($i = 1; $i<24;$i++){
                if(!isset($_POST["price_hora_".$i]) ||  $_POST["price_hora_".$i]=="" ||  intval($_POST["price_hora_".$i])<0){
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error guardando en base de datos.";
                    $result = array("status"=>$status,"message"=>$message);
                    echo json_encode("ingresa un valor valido para la hora ".$i);
                    return ;
                }
            }
            //validar si el tipo de habitacion  existe
            $existeTipo = $this->masterModel->sqlSelect("SELECT id_tipo_habitacion FROM tipo_habitacion WHERE th_nombre_tipo = ? ",array($request["nombre_tipo"]));
            if(empty($existeTipo)){
                if($request["valor_hora"]>0 && $request["valor_persona_adicional"]>0){
                    $request["th_fecha_creacion"] = date("Y-m-d");
                    $request["th_estado"] = 1;
                    $insert = $this->masterModel->insert("tipo_habitacion",array($request["nombre_tipo"],strval($request["descripcion"]),$request["valor_hora"],$request["valor_persona_adicional"],$request["th_estado"],$request["th_fecha_creacion"],$request["price_hora_1"],$request["price_hora_2"],$request["price_hora_3"],$request["price_hora_4"],$request["price_hora_5"],$request["price_hora_6"],$request["price_hora_7"],$request["price_hora_8"],$request["price_hora_9"],$request["price_hora_10"],$request["price_hora_11"],$request["price_hora_12"],$request["price_hora_13"],$request["price_hora_14"],$request["price_hora_15"],$request["price_hora_16"],$request["price_hora_17"],$request["price_hora_18"],$request["price_hora_19"],$request["price_hora_20"],$request["price_hora_21"],$request["price_hora_22"],$request["price_hora_23"],$request["price_hora_24"]),array("id_tipo_habitacion"));
                    if($insert){
                        $status = "success";
                        $message = "Tipo de habitación registrado exitosamente.";
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "error guardando en base de datos.";
                    }
                }else{
                    header('Internal server error', true, 500);
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
            //validar los precios
            for($i = 1; $i<24;$i++){
                if(!isset($_POST["price_hora_".$i]) ||  $_POST["price_hora_".$i]=="" ||  intval($_POST["price_hora_".$i])<0){
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error guardando en base de datos.";
                    $result = array("status"=>$status,"message"=>$message);
                    echo json_encode("ingresa un valor valido para la hora ".$i);
                    return ;
                }
            }
            //validar si el tipo de habitacion  existe
            $existeTipo = $this->masterModel->sqlSelect("SELECT id_tipo_habitacion FROM tipo_habitacion WHERE id_tipo_habitacion = ? ",array($request["id"]));
            if(!empty($existeTipo)){
                //saber si el estado es valido
                if($request["estado"]==0 || $request["estado"] ==1){
                    if($request["valor_hora"]>0 && $request["valor_persona_adicional"]>0){
                        $insert = $this->masterModel->sql("UPDATE tipo_habitacion SET  th_nombre_tipo = ?, th_descripcion = ?,th_valor_hora_despues24 = ?, th_valor_persona_adicional = ?, th_estado = ? , th_valor_hora1 = ?,th_valor_hora2 = ?,th_valor_hora3 = ?,th_valor_hora4 = ?,th_valor_hora5 = ?,th_valor_hora6 = ?,th_valor_hora7 = ?,th_valor_hora8 = ?,th_valor_hora9 = ?,th_valor_hora10 = ?,th_valor_hora11 = ?,th_valor_hora12 = ?,th_valor_hora13 = ?,th_valor_hora14 = ?,th_valor_hora15 = ?,th_valor_hora16 = ?,th_valor_hora17 = ?,th_valor_hora18 = ?,th_valor_hora19 = ?,th_valor_hora20 = ?,th_valor_hora21 = ?,th_valor_hora22 = ?,th_valor_hora23 = ?,th_valor_hora24 = ? WHERE id_tipo_habitacion = ? ",array($request["nombre_tipo"],$request["descripcion"],$request["valor_hora"],$request["valor_persona_adicional"],$request["estado"],$request["price_hora_1"],$request["price_hora_2"],$request["price_hora_3"],$request["price_hora_4"],$request["price_hora_5"],$request["price_hora_6"],$request["price_hora_7"],$request["price_hora_8"],$request["price_hora_9"],$request["price_hora_10"],$request["price_hora_11"],$request["price_hora_12"],$request["price_hora_13"],$request["price_hora_14"],$request["price_hora_15"],$request["price_hora_16"],$request["price_hora_17"],$request["price_hora_18"],$request["price_hora_19"],$request["price_hora_20"],$request["price_hora_21"],$request["price_hora_22"],$request["price_hora_23"],$request["price_hora_24"],$request["id"]));
                        if($insert){
                            $status = "success";
                            $message = "Tipo de habitación modificada exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "El nombre del tipo de habitación ya ha sido registrado.";
                        }
                    }else{
                        header('Internal server error', true, 500);
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
            $existeTipo = $this->masterModel->sqlSelect("SELECT id_tipo_habitacion FROM tipo_habitacion WHERE id_tipo_habitacion = ?",array($request["id"]));
            if(!empty($existeTipo)){
                $eliminar = $this->masterModel->sql("UPDATE tipo_habitacion SET th_estado = ? WHERE id_tipo_habitacion = ?",array(0,$_POST["id"]));
                if($eliminar){
                    $status = "success";
                    $message = "Tipo de habitacion eliminada.";
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