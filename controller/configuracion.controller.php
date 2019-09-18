<?php 
Class ConfiguracionController{
    private  $masterModel;
    private $doizer;
    function ConfiguracionController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }
    function UptadeConfig(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //datos
            if($request["iva"]>0){
                if($request["minutos_cortesia"]>0 && $request["precio_decoracion"]>0){
                    $update = $this->masterModel->sql("UPDATE villa_config SET conf_iva = ?, conf_minutos_cortesia = ? ,conf_precio_decoracion = ? , id_usuario = ? WHERE id_conf = ?",array($request["iva"],$request["minutos_cortesia"],$request["precio_decoracion"],$_SESSION["DATA_USER"]["ID"],1));
                    if($update){
                        $status = "success";
                        $message = "Configuración Modificada exitosamente.";
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "error guardando en base de datos.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Por favor ingresa los minutos de cortesia o un precio válido.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el iva.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function readByConfig(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->selectAll("villa_config")[0];
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
}
?>