<?php 
Class ProcessController{
    private  $masterModel;
    private $doizer;
    function ProcessController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function iniciarProceso(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataProcess = $this->masterModel->sqlSelect("SELECT *  FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND tipo_pago = ? ORDER BY fac_consecutivo ASC",array($request["fecha_inicio"]." 00:00:01",$request["fecha_fin"]." 23:59:59","efectivo"));
            $valorTotal = $this->masterModel->sqlSelect("SELECT SUM(valor_factura) as valor FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND tipo_pago = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_fin"]." 23:59:59","efectivo"))[0]->valor;
            
            if(empty($dataProcess )){
                header('Internal server error', true, 500);
                $status = "error";
                $message = "No hay registros en este rango de fecha.";
                $data = null;
            }else{
                $status = "success";
                $message = "Proceso Realizado exitosamente.";
                $data = $dataProcess;
            }
            $result = array("status"=>$status,"message"=>$message,"data"=>$dataProcess,"valorTotal"=> number_format($valorTotal));
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function confirmarProceso(){
        $request = $_POST;
        $dataProcess = $this->masterModel->sqlSelect("SELECT valor_factura,fac_consecutivo  FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND tipo_pago = ? ORDER BY fac_consecutivo ASC",array($request["fecha_inicio"]." 00:00:01",$request["fecha_fin"]." 23:59:59","efectivo"));
        $valorTotal = $this->masterModel->sqlSelect("SELECT SUM(valor_factura) as valor FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND tipo_pago = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_fin"]." 23:59:59","efectivo"))[0]->valor;
        
        $valorEliminar = (intval($valorTotal)*intval($request["porcentaje"]))/100;
        
        //inicializar variables 
        $valorEliminado = 0;
        $facturasEliminadas = array();
        $todasLasFacturas = array();
        $this->realizarBackup();
        //ver que fatcuras eliminar  facturas
        $i = 0;
        foreach( $dataProcess as $factura){
            $todasLasFacturas[] = $factura->fac_consecutivo;
            $valorEliminado += intval($factura->valor_factura);
            if($valorEliminado>$valorEliminar){
                $valorEliminado =  $valorEliminado-intval($factura->valor_factura);
                // break;
            }else{
                $facturasEliminadas[]= $factura->fac_consecutivo;
            }
            $i++;
        }
        //eliminar Facturas
        foreach($facturasEliminadas as $factura){
            $this->masterModel->delete("facturas",array("fac_consecutivo",$factura));
        }
        $facturasRestantes = array_diff($todasLasFacturas,$facturasEliminadas); 
        rsort($facturasRestantes);
        //reorganizar Indices
        $i = 0;
        foreach($facturasRestantes as $factura){
            $this->masterModel->sql("UPDATE facturas SET fac_consecutivo = ? WHERE fac_consecutivo = ?",array($facturasEliminadas[$i],$factura));
        }
        $this->masterModel->insert("historial_proceso",array(date("Y-m-d"),$request["porcentaje"],$valorEliminar,$valorEliminado,implode(",",$facturasEliminadas),implode(",",$facturasRestantes)),array("id_historial"));
        $result  = array("valorQueSeDebeEliminar"=>$valorEliminar,"facturas"=>$dataProcess,"valorEliminado"=>$valorEliminado,"facturasEliminadas"=>$facturasEliminadas,"todasLasFaturas"=>$todasLasFacturas,"facurasRestantes"=>$facturasRestantes );
        echo json_encode($result);

    }
    function realizarBackup(){
        $this->doizer->exportarTablas("localhost", "root", "", "villa_campestre");
    }
}
?>