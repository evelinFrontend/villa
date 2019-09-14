<?php 
Class TurnosController{
    private  $masterModel;
    private $doizer;
    function TurnosController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createTurn(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si la categoris  existe
            $request["fecha_ingreso"] = date("Y-m-d");
            $request["hora_ingreso"] = date("h:i:s");
            if($request["usuario"]!= ""){
                $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_id = ? ",array($request["usuario"]));
                if(!empty($existeUsuario)){
                    $existeTurno = $this->masterModel->sqlSelect("SELECT id_control FROM control_turnos WHERE id_usuario = ? AND fecha_turno = ? ",array($request["usuario"],$request["fecha_ingreso"]));
                    if(empty($existeTurno)){
                        $insert = $this->masterModel->insert("control_turnos",array($request["usuario"],$request["valor_inicial"],$request["fecha_ingreso"],$request["hora_ingreso"]),array("id_control","factura_inicio","factura_fin","hora_fin","valor_total_cierre","total_facturas_realizadas"));
                        if($insert){
                            $status = "success";
                            $message = "Turno registrado exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Este usuario ya registro su turno el día de hoy.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Este usuario no esta registrado en nuestro sistema.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa un usuario.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function obtenerFacturaInicio($fecha){
        $facturaInicioDia = $this->masterModel->sqlSelect("SELECT MIN(id_factura) AS numero_factura FROM facturas WHERE fa_fecha_factura = ? ",array($fecha))[0];
        return $facturaInicioDia->numero_factura;         
    }
    function obtenerFacturaFin($fecha){
        $facturaInicioDia = $this->masterModel->sqlSelect("SELECT MAX(id_factura) AS numero_factura FROM facturas WHERE fa_fecha_factura = ? ",array($fecha))[0];
        return $facturaInicioDia->numero_factura;        
    }
    function UptadeTurn(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si la categoris  existe
            $request["hora_fin"] = date("h:i:s");
            if($request["usuario"]!= ""){
                $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_id = ? ",array($request["usuario"]));
                if(!empty($existeUsuario)){
                    $existeTurno = $this->masterModel->sqlSelect("SELECT id_control FROM control_turnos WHERE id_usuario = ? AND fecha_turno = ? ",array($request["usuario"],date("Y-m-d")));
                    if(!empty($existeTurno)){
                        $request["valor_total_cierre"] = 2000;
                        $request["total_facturas_realizadas"] = 20;
                        $insert = $this->masterModel->sql("UPDATE control_turnos SET factura_fin = ?,hora_fin = ?,valor_total_cierre = ?, total_facturas_realizadas = ?  WHERE id_usuario = ? AND fecha_turno = ?",array(0,$request["hora_fin"],$request["valor_total_cierre"],$request["total_facturas_realizadas"],$request["usuario"],date("Y-m-d")));
                        if($insert){
                            $status = "success";
                            $message = "Turno modificado exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Este usuario no ha registrado su turno el día de hoy.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Este usuario no esta registrado en nuestro sistema.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa un usuario.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function  mostrarAbrirTurno(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->sqlSelect("SELECT id_control FROM control_turnos WHERE id_usuario = ? AND fecha_turno = ? ",array($_SESSION["DATA_USER"]["ID"],date("Y-m-d")));
        if(!empty($dataType)){
            $status = "success";
            $message = "Este usuario ya inicio turno el dia de hoy.";
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "Este usuario debe iniciar turno.";
        }
        $result = array("status"=>$status,"message"=>$message);
        echo json_encode($result);
    }    
}
?>