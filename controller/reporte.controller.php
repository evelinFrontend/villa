<?php 
Class ReporteController{
    private  $masterModel;
    private $doizer;
    function ReporteController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function readByCountCortesia(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->sqlSelect("SELECT COUNT(*) as cantidadCortesias FROM `cortesia` WHERE MONTH(cor_fecha_hora_ingreso) = ? AND  YEAR(cor_fecha_hora_ingreso) = ?",array(date("m"),date("Y")));
        if(!empty($dataType)){
            $status = "success";
            $message = "Consultas realizada.";
            $data = $dataType[0];
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
        }
        $result = array("status"=>$status,"message"=>$message,"data"=>$data);
        echo json_encode($result);
    }    
    //obtener los tipos de reservas del mes
    function obtenerReporteGraficaInicio(){
        header('Content-Type:application/json');
        $request = $_POST;
        $cantidadCortesias = $this->masterModel->sqlSelect("SELECT COUNT(*) as cantidadCortesias FROM `cortesia` WHERE MONTH(cor_fecha_hora_ingreso) = ? AND  YEAR(cor_fecha_hora_ingreso) = ?",array(date("m"),date("Y")))[0];
        $cantidadPromociones = $this->masterModel->sqlSelect("SELECT COUNT(*) as cantidadPromociones FROM `facturas` WHERE MONTH(fac_fecha_hora_ingreso) = ? AND  YEAR(fac_fecha_hora_ingreso) = ? AND tipo_reserva = ?",array(date("m"),date("Y"),5))[0];
        $cantidadReservas = $this->masterModel->sqlSelect("SELECT COUNT(*) as cantidadReservas FROM `facturas` WHERE MONTH(fac_fecha_hora_ingreso) = ? AND  YEAR(fac_fecha_hora_ingreso) = ? AND tipo_reserva = ?",array(date("m"),date("Y"),2))[0];
        $cantidadAnulaciones = $this->masterModel->sqlSelect("SELECT COUNT(*) as cantidadAnulaciones FROM `reservas_anuladas` WHERE MONTH(ranula_fecha_hora_ingreso) = ? AND  YEAR(ranula_fecha_hora_ingreso) = ?",array(date("m"),date("Y")));
        if(!empty($cantidadCortesias)){
            $status = "success";
            $message = "Consultas realizada.";
            $data = array("cantidadCortesias"=>$cantidadCortesias,"cantidadPromociones"=>$cantidadPromociones,"cantidadReservas"=>$cantidadReservas,"cantidadAnulaciones"=>$cantidadAnulaciones);
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