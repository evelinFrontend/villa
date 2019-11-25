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
    
    function previewProcess(){
        $request = $_POST;
        $dataProcess = $this->masterModel->sqlSelect("SELECT valor_factura,fac_consecutivo,fac_hora_salida,tipo_pago  FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND tipo_pago = ? ORDER BY fac_consecutivo ASC",array($request["fecha_inicio"]." 00:00:01",$request["fecha_fin"]." 23:59:59","efectivo"));
        $valorTotal = $this->masterModel->sqlSelect("SELECT SUM(valor_factura) as valor FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? AND tipo_pago = ?",array($request["fecha_inicio"]." 00:00:01",$request["fecha_fin"]." 23:59:59","efectivo"))[0]->valor;
        $valorEliminar = (intval($valorTotal)*intval($request["porcentaje"]))/100;
        //inicializar variables 
        $valorEliminado = 0;
        $facturasEliminadas = array();
        $facturasEliminadasNoMostrar = array();
        $todasLasFacturas = array();
        //ver que fatcuras eliminar  facturas
        $i = 0;
        foreach( $dataProcess as $factura){
            $todasLasFacturas[] = $factura->fac_consecutivo;
            $valorEliminado += intval($factura->valor_factura);
            if($valorEliminado>$valorEliminar){
                $valorEliminado =  $valorEliminado-intval($factura->valor_factura);
                // break;
            }else{
                $facturasEliminadas[]= array("consecutivo"=>$factura->fac_consecutivo,"fecha"=>$factura->fac_hora_salida,"valor"=>$factura->valor_factura,"tipoPago"=>$factura->tipo_pago);
                $facturasEliminadasNoMostrar[]=$factura->fac_consecutivo;
            }
            $i++;
        }
        $facturasRestantes = array_diff($todasLasFacturas,$facturasEliminadasNoMostrar); 
        rsort($facturasRestantes);
        $facurasRestantesMostrar = array();
        //Saber nuevos indices
        $nuevosIndices = $this->masterModel->sqlSelect("SELECT valor_factura,fac_consecutivo,fac_hora_salida,tipo_pago  FROM facturas ORDER BY  fac_consecutivo DESC LIMIT ".count($facturasEliminadasNoMostrar),array(""));
        $i=0;
        foreach($facturasRestantes as $factura){
            $facurasRestantesMostrar[] = $this->masterModel->sqlSelect("SELECT valor_factura,fac_consecutivo,fac_hora_salida,tipo_pago  FROM facturas WHERE  fac_consecutivo = ?",array($factura))[0];
            // $facurasRestantesMostrar[$i]->nuevo_consecutivo = $nuevosIndices[$i]->fac_consecutivo;
            $i++;
        }
        $result  = array("valorQueSeDebeEliminar"=>$valorEliminar,"facturas"=>$dataProcess,"valorEliminado"=>$valorEliminado,"facturasEliminadas"=>$facturasEliminadas,"todasLasFaturas"=>$todasLasFacturas,"facurasRestantes"=>$facturasRestantes ,"facurasRestantesMostrar"=>$facurasRestantesMostrar,"nuevosIndices"=>$nuevosIndices);
        echo json_encode($result);

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
            $this->masterModel->delete("detalle_factura",array("fac_consecutivo",$factura));
        }
        $facturasRestantes = array_diff($todasLasFacturas,$facturasEliminadas); 
        rsort($facturasRestantes);
        //reorganizar Indices
        $i = 0;
        foreach($facturasRestantes as $factura){
            $this->masterModel->sql("UPDATE facturas SET fac_consecutivo = ? WHERE fac_consecutivo = ?",array($facturasEliminadas[$i],$factura));
            $i++;
        }
        $this->masterModel->insert("historial_proceso",array(date("Y-m-d"),$request["porcentaje"],$valorEliminar,$valorEliminado,implode(",",$facturasEliminadas),implode(",",$facturasRestantes)),array("id_historial"));
        $result  = array("valorQueSeDebeEliminar"=>$valorEliminar,"facturas"=>$dataProcess,"valorEliminado"=>$valorEliminado,"facturasEliminadas"=>$facturasEliminadas,"todasLasFaturas"=>$todasLasFacturas,"facurasRestantes"=>$facturasRestantes );
        echo json_encode($result);

    }
    function realizarBackup(){
        $this->doizer->exportarTablas("localhost", "root", "", "villa_campestre");
    }


    function reorganizarIndices(){
        $this->realizarBackup();
        $request = $_POST;
        $result = $this->masterModel->sqlSelect("SELECT fac_consecutivo FROM facturas WHERE fac_hora_salida LIKE ? ORDER BY fac_consecutivo ASC",array($request["fecha"]."%"));
        $modificaciones = array();
        $contador =  $result[0]->fac_consecutivo;
        foreach($result as $row){
            if($row->fac_consecutivo!=$contador){
                if(!empty($this->masterModel->sqlSelect("SELECT fac_consecutivo FROM facturas WHERE  fac_consecutivo = ? ",array($row->fac_consecutivo+1)))){
                    $update = $this->masterModel->sql("UPDATE facturas SET fac_consecutivo = ? WHERE fac_consecutivo = ? ",array($contador,$row->fac_consecutivo+1));
                }else{
                    $update = $this->masterModel->sql("UPDATE facturas SET fac_consecutivo = ? WHERE fac_consecutivo = ? ",array($contador,$row->fac_consecutivo));
                }
                $modificaciones[]= $row->fac_consecutivo;
            }
            $contador++;
        }
        echo json_encode(implode(",",$modificaciones));
    }
}
?>