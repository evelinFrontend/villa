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
            if($_SESSION["DATA_USER"]["ID"]!= ""){
                $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_id = ? ",array($_SESSION["DATA_USER"]["ID"]));
                if(!empty($existeUsuario)){
                    $existeTurno = $this->masterModel->sqlSelect("SELECT id_control FROM control_turnos WHERE id_usuario = ? AND fecha_turno = ? ",array($_SESSION["DATA_USER"]["ID"],$request["fecha_ingreso"]));
                    if(empty($existeTurno)){
                        $insert = $this->masterModel->insert("control_turnos",array($_SESSION["DATA_USER"]["ID"],$request["valor_inicial"],$request["fecha_ingreso"],$request["hora_ingreso"]),array("id_control","factura_inicio","factura_fin","hora_fin","valor_total_cierre","total_facturas_realizadas","total_efectivo","total_credito","total_transferencia"));
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
        $request = $_POST;
        //validar  si la categoris  existe
        $request["hora_fin"] = date("h:i:s");
        if($_SESSION["DATA_USER"]["ID"]!= ""){
            $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_id = ? ",array($_SESSION["DATA_USER"]["ID"]));
            if(!empty($existeUsuario)){
                $existeTurno = $this->masterModel->sqlSelect("SELECT id_control FROM control_turnos WHERE id_usuario = ? AND fecha_turno = ? ",array($_SESSION["DATA_USER"]["ID"],date("Y-m-d")));
                if(!empty($existeTurno)){
                    $totalFacturasRealizadas = $this->masterModel->sqlSelect("SELECT COUNT(fac_consecutivo) as totalFacturas FROM facturas WHERE id_usuario = ? AND fac_hora_salida BETWEEN  ? AND ? ",array($_SESSION["DATA_USER"]["ID"],date("Y-m-d")." 00:00:01",date("Y-m-d")." 23:59:59"))[0]->totalFacturas;
                    $facturaInicio = $this->masterModel->sqlSelect("SELECT MIN(fac_consecutivo) as facturaInicio FROM facturas WHERE id_usuario = ? AND fac_hora_salida BETWEEN  ? AND ? ORDER BY fac_hora_salida DESC",array($_SESSION["DATA_USER"]["ID"],date("Y-m-d")." 00:00:01",date("Y-m-d")." 23:59:59"))[0]->facturaInicio;
                    $facturaFin = $this->masterModel->sqlSelect("SELECT MAX(fac_consecutivo) as facturaFin FROM facturas WHERE id_usuario = ? AND fac_hora_salida BETWEEN  ? AND ? ORDER BY fac_hora_salida DESC",array($_SESSION["DATA_USER"]["ID"],date("Y-m-d")." 00:00:01",date("Y-m-d")." 23:59:59"))[0]->facturaFin;
                    $metodosPago = $this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo,SUM(fac_valor_credito) as totalCredito,SUM(fac_valor_transferencia) as totalTransferencia  FROM facturas WHERE id_usuario = ? AND fac_hora_salida BETWEEN  ? AND ? ",array($_SESSION["DATA_USER"]["ID"],date("Y-m-d")." 00:00:01",date("Y-m-d")." 23:59:59"))[0];
                    $totalVentasTurno = intval($metodosPago->totalEfectivo)+intval($metodosPago->totalCredito)+intval($metodosPago->totalTransferencia);
                    
                    $insert = $this->masterModel->sql("UPDATE control_turnos SET factura_inicio = ?, factura_fin = ?,hora_fin = ?,valor_total_cierre = ?, total_facturas_realizadas = ?  ,total_efectivo = ?,total_credito = ?,total_transferencia = ? WHERE id_usuario = ? AND fecha_turno = ?",array($facturaInicio,$facturaFin,$request["hora_fin"],$totalVentasTurno,$totalFacturasRealizadas,$metodosPago->totalEfectivo,$metodosPago->totalCredito,$metodosPago->totalTransferencia,$_SESSION["DATA_USER"]["ID"],date("Y-m-d")));
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