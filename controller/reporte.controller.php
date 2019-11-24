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
    function guardarFechas(){
        if(!empty($_POST)){
            $request = $_POST;
            $_SESSION["FECHA_INICIO_REPORTE"] = $request["fecha_inicio"];
            $_SESSION["FECHA_FIN_REPORTE"] = $request["fecha_final"];
            echo json_encode(true);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    function reporteVentas(){
        $request["fecha_inicio"] = $_SESSION["FECHA_INICIO_REPORTE"];
        $request["fecha_final"] =  $_SESSION["FECHA_FIN_REPORTE"];
        $catidadDeFacturas = $this->masterModel->sqlSelect("SELECT COUNT(*) as catidadDeFacturas FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->catidadDeFacturas;
        $totalEfectivo = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalEfectivo);
        $totalCredito = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
        $totalTransferencia = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_transferencia) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
        $totalVentas = ($this->masterModel->sqlSelect("SELECT SUM(valor_factura) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
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
            require_once "views/modules/admin/reports/reporteVentas.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
    function reporteVentasTurno(){
        $request["fecha_inicio"] = $_SESSION["FECHA_INICIO_REPORTE"];
        $request["fecha_final"] =  $_SESSION["FECHA_FIN_REPORTE"];
        $catidadDeFacturas = $this->masterModel->sqlSelect("SELECT COUNT(*) as catidadDeFacturas FROM facturas WHERE id_usuario= ? AND fac_hora_salida BETWEEN ? AND ?",array($_SESSION["DATA_USER"]["ID"],$request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->catidadDeFacturas;
        $totalEfectivo = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo FROM facturas WHERE id_usuario= ? AND fac_hora_salida BETWEEN ? AND ?",array($_SESSION["DATA_USER"]["ID"],$request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalEfectivo);
        $totalCredito = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE id_usuario= ? AND fac_hora_salida BETWEEN ? AND ?",array($_SESSION["DATA_USER"]["ID"],$request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
        $totalTransferencia = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_transferencia) as totalTransferencia FROM facturas WHERE id_usuario= ? AND fac_hora_salida BETWEEN ? AND ?",array($_SESSION["DATA_USER"]["ID"],$request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
        $totalVentas = ($this->masterModel->sqlSelect("SELECT SUM(valor_factura) as totalTransferencia FROM facturas WHERE id_usuario= ? AND fac_hora_salida BETWEEN ? AND ?",array($_SESSION["DATA_USER"]["ID"],$request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
        $facturasRealizadas = $this->masterModel->sqlSelect("SELECT *  FROM facturas WHERE id_usuario= ? AND fac_hora_salida BETWEEN ? AND ?",array($_SESSION["DATA_USER"]["ID"],$request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"));
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
            require_once "views/modules/admin/reports/reporteVentas.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
    function reporteFormarDePago(){
        header('Content-Type:application/json');
        $request["fecha_inicio"] = $_SESSION["FECHA_INICIO_REPORTE"];
        $request["fecha_final"] =  $_SESSION["FECHA_FIN_REPORTE"];

        $totalEfectivo = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalEfectivo);
        $totalCredito = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
        $totalTransferencia = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_transferencia) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
        $totalVentas = ($this->masterModel->sqlSelect("SELECT SUM(valor_factura) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalTransferencia);
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
            require_once "views/modules/admin/reports/formasdepago.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
    function reporteInventario(){
        header('Content-Type:application/json');
        $request = $_POST;
        $inventario = $this->masterModel->sqlSelect("SELECT * FROM producto",array(""));
        if(!empty($inventario)){
            $status = "success";
            $message = "Consultas realizada.";
            $data = $inventario;
            require_once "views/modules/admin/reports/reporteInventario.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
    function reporteHabitaciones(){
        $request["fecha_inicio"] = $_SESSION["FECHA_INICIO_REPORTE"];
        $request["fecha_final"] =  $_SESSION["FECHA_FIN_REPORTE"];
        header('Content-Type:application/json');
        $resultReport = array();
        $habitaciones = $this->masterModel->sqlSelect("SELECT hab_numero FROM habitacion",array(""));
        if(!empty($habitaciones)){
            foreach($habitaciones as $room){
                $totalEfectivo = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_efectivo) as totalEfectivo FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND hab_numero = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59",$room->hab_numero))[0]->totalEfectivo);
                $totalCredito = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND hab_numero = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59",$room->hab_numero))[0]->totalCredito);
                $totalTransferencia = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_transferencia) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND hab_numero = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59",$room->hab_numero))[0]->totalTransferencia);
                $totalVentas = ($this->masterModel->sqlSelect("SELECT SUM(valor_factura) as totalTransferencia FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND hab_numero = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59",$room->hab_numero))[0]->totalTransferencia);
                $facturasRealizadas = $this->masterModel->sqlSelect("SELECT COUNT(*) AS  facturasRealizadas FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND hab_numero = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59",$room->hab_numero))[0]->facturasRealizadas;
                $resultReport[] = array(
                    "habitacion"=>$room->hab_numero,
                    "totalEfectivo"=>$totalEfectivo,
                    "totalCredito"=>$totalCredito,
                    "totalTransferencia"=>$totalTransferencia,
                    "totalVentas"=>$totalVentas,
                    "facturasRealizadas"=>$facturasRealizadas
                );
            }
            $status = "success";
            $message = "Consultas realizada.";
            $data = $resultReport;
            require_once "views/modules/admin/reports/reporteHabitaciones.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
    function  cortesiasRealizadas(){
        header('Content-Type:application/json');
        $request["fecha_inicio"] = $_SESSION["FECHA_INICIO_REPORTE"];
        $request["fecha_final"] =  $_SESSION["FECHA_FIN_REPORTE"];

        $dataCortesia = $this->masterModel->sqlSelect("SELECT *  FROM cortesia WHERE cor_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"));
        if(!empty($dataCortesia)){
            // $datallesCortesia = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
            $status = "success";
            $message = "Consultas realizada.";
            $data = $dataCortesia;
            require_once "views/modules/admin/reports/cortesiasRealizadas.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
    function  reservasCanceladas(){
        header('Content-Type:application/json');
        $request["fecha_inicio"] = $_SESSION["FECHA_INICIO_REPORTE"];
        $request["fecha_final"] =  $_SESSION["FECHA_FIN_REPORTE"];

        $data = $this->masterModel->sqlSelect("SELECT *  FROM reservas_anuladas WHERE ranula_fecha_hora_ingreso BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"));
        if(!empty($data)){
            // $datallesCortesia = ($this->masterModel->sqlSelect("SELECT SUM(fac_valor_credito) as totalCredito FROM facturas WHERE fac_hora_salida BETWEEN ? AND ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_final"]." 23:59:59"))[0]->totalCredito);
            $status = "success";
            $message = "Consultas realizada.";
            require_once "views/modules/admin/reports/reservasAnuladas.php"; 
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica los parametros.";
            $data = null;
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            echo json_encode($result);
        }
    }
}
?>