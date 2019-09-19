<?php 
Class PromocionController{
    private  $masterModel;
    private $doizer;
    function PromocionController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }
    function createPromo(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            if($request["nombre"]!= ""){
                if($request["duracion"]!= ""){
                    if($request["valor"]!= ""){
                        $request["estado"] = 1;
                        $insert = $this->masterModel->insert("promocion",array($request["nombre"],$request["duracion"],$request["valor"],date("Y-m-d"),$_SESSION["DATA_USER"]["ID"],$request["estado"] ),array("id_promocion"));
                        if($insert){
                            $status = "success";
                            $message = "Promoción registrada exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos,es posible que otra promoción este registrada con este nombre.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el valor de la promoción.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Por favor ingresa la duración de la promoción.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el nombre de  la promoción.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UptadePromo(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si  la promocion existe
            $promocion = $this->masterModel->sqlSelect("SELECT id_promocion FROM promocion WHERE id_promocion = ? ",array($request["id"]));
                if(!empty($promocion)){
                    if($request["nombre"]!= ""){
                        if($request["duracion"]!= ""){
                            if($request["valor"]!= ""){
                                if($request["estado"]==1 || $request["estado"]==0){
                                    $update = $this->masterModel->sql("UPDATE promocion SET promo_nombre = ?, promo_tiempo = ?, promo_valor = ?, id_usuario = ?, promo_estado = ?  WHERE id_promocion = ?",array($request["nombre"],$request["duracion"],$request["valor"],$_SESSION["DATA_USER"]["ID"],$request["estado"],$request["id"]));
                                    if($update){
                                        $status = "success";
                                        $message = "Promoción Modificada exitosamente.";
                                    }else{
                                        header('Internal server error', true, 500);
                                        $status = "error";
                                        $message = "error guardando en base de datos.";
                                    }
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "Ingresa un estado válido.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Por favor ingresa el valor de la promoción.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa la duración de la promoción.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el nombre de  la promoción.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Esta Promoción no esta registrada en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function cambiarEstadoPromo(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar la promocion
            $promocion = $this->masterModel->sqlSelect("SELECT id_promocion FROM promocion WHERE id_promocion = ? ",array($request["id"]));
            if(!empty($promocion)){
                if($request["estado"]==1 || $request["estado"]==0){
                    $update = $this->masterModel->sql("UPDATE promocion SET promo_estado = ?  WHERE id_promocion = ?",array($request["estado"],$request["id"]));
                    if($update){
                        $status = "success";
                        if($request["estado"]==1){
                            $message = "Promoción Activada.";
                        }else{
                            $message = "Promoción inactivada.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Debido a que esta promoción tiene facturas relacionados no se puede eliminar.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Ingresa un estado válido.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Esta promoción no esta  registrada en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readByPromo(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM promocion WHERE ".$request['columnDBSearch']." = ? ",array($request["value"]));
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