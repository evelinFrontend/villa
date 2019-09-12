
<?php 
Class EstadoReservaController{
    private  $masterModel;
    private $doizer;
    function EstadoReservaController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function UptadeStateR(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si  el estado de la reserva existe
            $estadoReserva = $this->masterModel->sqlSelect("SELECT sr_estado_reserva FROM estado_reserva WHERE sr_estado_reserva = ? ",array($request["id"]));
            if(!empty($estadoReserva)){
                    if($request["nombre"]!= ""){
                        if($request["color"]!= ""){
                            $delete = $this->masterModel->sql("UPDATE estado_reserva SET sr_nombre = ?, sr_descripcion = ?, sr_color = ? WHERE sr_estado_reserva = ?",array($request["nombre"],$request["descripcion"],$request["color"],$request["id"]));
                            if($delete){
                                $status = "success";
                                $message = "Estado Modificado exitosamente.";
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "error guardando en base de datos.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor color diferenciador del estado.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el nombre del estado.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este Estado no esta registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function readBystateR(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM estado_reserva WHERE ".$request['columnDBSearch']." = ? ",array($request["value"]));
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