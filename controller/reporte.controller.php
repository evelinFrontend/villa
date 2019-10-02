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
    
    function reporteVentas(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $catidadDeFacturas = $this->masterModel->sqlSelect("SELECT COUNT(*) as catidadDeFacturas FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->catidadDeFacturas;
            $totalEfectivo = number_format($this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalEfectivo);
            $totalCredito = number_format($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
            $totalTransferencia = number_format($this->masterModel->sqlSelect("SELECT SUM(fac_valor_transferencia) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
            $totalVentas = number_format($this->masterModel->sqlSelect("SELECT SUM(valor_factura) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
            $facturasRealizadas = $this->masterModel->sqlSelect("SELECT *  FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"));
            $productos = array();
            if(!empty($catidadDeFacturas)){
                foreach($facturasRealizadas as $fatura){
                    $fatura->productos = $this->masterModel->sqlSelect("SELECT df.*,p.pro_nombre FROM detalle_factura df INNER JOIN  producto p ON p.id_producto = df.det_id_producto WHERE  fac_consecutivo =  ?",array($fatura->fac_consecutivo));
                    $productos[]=$this->masterModel->sqlSelect("SELECT df.*,p.pro_nombre FROM detalle_factura df INNER JOIN  producto p ON p.id_producto = df.det_id_producto WHERE  fac_consecutivo =  ?",array($fatura->fac_consecutivo));
                }
                $status = "success";
                $message = "Consultas realizada.";
                $data = array(
                    "catidadDeFacturas"=>$catidadDeFacturas,
                    "totalEfectivo"=>$totalEfectivo,
                    "totalCredito"=>$totalCredito,
                    "totalTransferencia"=>$totalTransferencia,
                    "totalVentas"=>$totalVentas,
                    "facturasRealizadas" => $facturasRealizadas,
                    "productosVendidos" =>$productos
                );
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
    function reporteFormarDePago(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $totalEfectivo = number_format($this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalEfectivo);
            $totalCredito = number_format($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
            $totalTransferencia = number_format($this->masterModel->sqlSelect("SELECT SUM(fac_valor_transferencia) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
            $totalVentas = number_format($this->masterModel->sqlSelect("SELECT SUM(valor_factura) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
            $facturasRealizadas = $this->masterModel->sqlSelect("SELECT *  FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"));
            if(!empty($facturasRealizadas)){
                $status = "success";
                $message = "Consultas realizada.";
                $data = array(
                    "totalEfectivo"=>$totalEfectivo,
                    "totalCredito"=>$totalCredito,
                    "totalTransferencia"=>$totalTransferencia,
                    "totalVentas"=>$totalVentas
                );
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