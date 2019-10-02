<?php 
require_once "controller/reserva.controller.php";
Class FacturaController{
    private  $masterModel;
    private $doizer;
    private $reservasController;
    function FacturaController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
        $this->reservasController = new ReservaController($masterModel,$doizer);
    }

    function reservaAfactura(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataReserva = $this->reservasController->detallesReserva($request["habitacion"]);
            if($dataReserva["status"]=="success"){
                //validar tipo de pago
                if(isset($request["tipo_pago"]) && $request["tipo_pago"]!=""){
                    if($request["tipo_pago"]=="efectivo"){
                        $request["cantidad_credito"] = 0;
                        $request["cantidad_transferencia"] = 0;
                        if($request["cantidad_efectivo"]=="" ||  $request["cantidad_efectivo"]!=$dataReserva["data"]["financieros"]["total"]){
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa el total adecuado en efectivo.";
                            $result = array("status"=>$status,"message"=>$message,"factura"=>null,"data"=>null);
                            echo json_encode($result);
                            return ;
                        }
                    }else if($request["tipo_pago"]=="credito"){
                        $request["cantidad_efectivo"] =0;
                        $request["cantidad_transferencia"] = 0;
                        if( $request["cantidad_credito"]=="" ||  $request["cantidad_credito"]!=$dataReserva["data"]["financieros"]["total"]){
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa el total adecuado en credito.";
                            $result = array("status"=>$status,"message"=>$message,"factura"=>null,"data"=>null);
                            echo json_encode($result);
                            return ;
                        }
                    }else if($request["tipo_pago"]=="transferencia"){
                        $request["cantidad_efectivo"] =0;
                        $request["cantidad_credito"] = 0;
                        if($request["cantidad_transferencia"]=="" || $request["cantidad_transferencia"]!=$dataReserva["data"]["financieros"]["total"]){
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa el total adecuado en transferencia.";
                            $result = array("status"=>$status,"message"=>$message,"factura"=>null,"data"=>null);
                            echo json_encode($result);
                            return ;
                        }
                    }else if($request["tipo_pago"]=="mixto"){
                        if($request["cantidad_efectivo"]>=0 && $request["cantidad_efectivo"]>=0 && $request["cantidad_efectivo"] >= 0){
                            $totalIngresadoPagoMixto = intval($request["cantidad_efectivo"])+intval($request["cantidad_credito"])+intval($request["cantidad_transferencia"]);
                            if($totalIngresadoPagoMixto!=$dataReserva["data"]["financieros"]["total"]){
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Por favor ingresa el total adecuado  para el pago mixto.";
                                $result = array("status"=>$status,"message"=>$message,"factura"=>null,"data"=>null);
                                echo json_encode($result);
                                return ;
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa las cantidades válidas.";
                            $result = array("status"=>$status,"message"=>$message,"factura"=>null,"data"=>null);
                            echo json_encode($result);
                            return ;
                        }
                    }
                }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa tu metodo de pago.";
                        $result = array("status"=>$status,"message"=>$message,"factura"=>null,"data"=>null);
                        echo json_encode($result);
                        return ;
                }
                $valorIva = $this->masterModel->sqlSelect("SELECT  conf_iva FROM villa_config",array(""))[0]->conf_iva;
                // --------fin validaciones tipo de pago------
                if( $dataReserva["data"]["reserva"]->ra_tipo_reserva_inicio=="4"){
                    $cortesia = $this->crearCortesia($dataReserva,$request);
                    return ;
                }else{
                    $numeroDefactura = $this->masterModel->sqlSelect("SELECT MAX(fac_consecutivo) as ultimaFactura FROM facturas",array(""))[0]->ultimaFactura+1;
                    $excepciones = array();
                    //saber si existe promocion
                    if(isset($dataReserva["data"]["reserva"]->promo_id)){
                        $insert = $this->masterModel->insert("facturas",array(
                            $numeroDefactura,
                            $dataReserva["data"]["reserva"]->id_reserva,
                            $dataReserva["data"]["reserva"]->hab_numero,
                            $dataReserva["data"]["reserva"]->id_usuario,
                            $dataReserva["data"]["reserva"]->promo_id,
                            $dataReserva["data"]["reserva"]->ra_fecha_hora_ingreso,
                            $dataReserva["data"]["reserva"]->ra_inicio_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_fin_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_numero_personas_adicionales,
                            $dataReserva["data"]["reserva"]->ra_habitacion_decorada,
                            date('Y-m-d H:i:s'),
                            $request["tipo_pago"],
                            $dataReserva["data"]["reserva"]->tiempo_transcurido,
                            $dataReserva["data"]["financieros"]["total"],
                            $dataReserva["data"]["reserva"]->ra_tipo_reserva_inicio,
                            $request["cantidad_efectivo"],
                            $request["cantidad_credito"],
                            $request["cantidad_transferencia"]
                         ),array(""));
                    }else{
                        $insert = $this->masterModel->insert("facturas",array(
                            $numeroDefactura,
                            $dataReserva["data"]["reserva"]->id_reserva,
                            $dataReserva["data"]["reserva"]->hab_numero,
                            $dataReserva["data"]["reserva"]->id_usuario,
                            $dataReserva["data"]["reserva"]->ra_fecha_hora_ingreso,
                            $dataReserva["data"]["reserva"]->ra_inicio_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_fin_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_numero_personas_adicionales,
                            $dataReserva["data"]["reserva"]->ra_habitacion_decorada,
                            date('Y-m-d H:i:s'),
                            $request["tipo_pago"],
                            $dataReserva["data"]["reserva"]->tiempo_transcurido,
                            $dataReserva["data"]["financieros"]["total"],
                            $dataReserva["data"]["reserva"]->ra_tipo_reserva_inicio,
                            $request["cantidad_efectivo"],
                            $request["cantidad_credito"],
                            $request["cantidad_transferencia"]
                         ),array("promo_id"));
                    }
                    //si los productos esta en 0 entrara al if
                    $insertProducts = true;
                    if($insert){
                        //agregar productos
                        foreach($dataReserva["data"]["productos"] as $product){
                            $insertProducts = $this->masterModel->insert("detalle_factura",array(
                                $numeroDefactura,
                                $product->re_det_id_producto,
                                $product->re_det_cantidad,
                                $product->re_precio_compra,
                                $product->re_det_valor_unidad,
                                $product->re_det_valor_total,
                                date('Y-m-d H:i:s')
                            ),array("id_detalle"));
                        }
                        if($insertProducts){
                            $deleteReserva=$this->masterModel->delete("reserva_activa",array("id_reserva",$dataReserva["data"]["reserva"]->id_reserva));
                            if($deleteReserva){
                                //cambiar habitacion a limpieza
                                $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE  hab_numero = ?",array(6,$dataReserva["data"]["reserva"]->hab_numero));
                                if($update){
                                    $status = "success";
                                    $message = "Factura creada.";
                                    $dataReserva["data"]["reserva"]->fecha= date('Y-m-d H:i:s');
                                    $dataReserva["data"]["financieros"]["tipo_pago"]= $request["tipo_pago"];
                                    $dataReserva["data"]["financieros"]["valor_pago_efectivo"]= $request["cantidad_efectivo"];
                                    $dataReserva["data"]["financieros"]["valor_pago_credito"]= $request["cantidad_credito"];
                                    $dataReserva["data"]["financieros"]["valor_pago_transferencia"]= $request["cantidad_transferencia"];
                                    $dataReserva["data"]["configuracion_factura"]= $this->masterModel->selectAll("villa_conf_facturas")[0];
                                    $dataReserva["data"]["financieros"]["iva"]=  ($dataReserva["data"]["financieros"]["total"]*intval($valorIva))/100;
                                    $dataReserva["data"]["financieros"]["baseIva"]=  number_format($dataReserva["data"]["financieros"]["total"]/119,2);
                                    $dataReserva["data"]["financieros"]["subtotal"]=  $dataReserva["data"]["financieros"]["total"]-$dataReserva["data"]["financieros"]["iva"];
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "Error al momento de cambiar el estado de la habitación.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Error al momento de guardar los productos de la factura.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Error al momento de guardar los productos de la factura.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Error al momento de guardar la factura.";
                    }
                }
                $result = array("status"=>$status,"message"=>$message,"factura"=>$numeroDefactura,"data"=>$dataReserva["data"]);
                echo json_encode($result);
            }else{
                echo json_encode($dataReserva);
            }
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    function obtenerDetallesTiempoParcial(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataReserva = $this->reservasController->detallesReserva($request["habitacion"]);
            if($dataReserva["status"]=="success"){
               $valorIva = $this->masterModel->sqlSelect("SELECT  conf_iva FROM villa_config",array(""))[0]->conf_iva;
                // --------fin validaciones tipo de pago------
                if( $dataReserva["data"]["reserva"]->ra_tipo_reserva_inicio=="4"){
                    $cortesia = $this->crearCortesia($dataReserva,$request);
                    return ;
                }else{
                    $numeroDefactura = $this->masterModel->sqlSelect("SELECT MAX(fac_consecutivo) as ultimaFactura FROM facturas",array(""))[0]->ultimaFactura+1;
                    $excepciones = array();
                    //saber si existe promocion
                    if(isset($dataReserva["data"]["reserva"]->promo_id)){
                        $insert = $this->masterModel->insert("facturas",array(
                            $numeroDefactura,
                            $dataReserva["data"]["reserva"]->id_reserva,
                            $dataReserva["data"]["reserva"]->hab_numero,
                            $dataReserva["data"]["reserva"]->id_usuario,
                            $dataReserva["data"]["reserva"]->promo_id,
                            $dataReserva["data"]["reserva"]->ra_fecha_hora_ingreso,
                            $dataReserva["data"]["reserva"]->ra_inicio_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_fin_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_numero_personas_adicionales,
                            $dataReserva["data"]["reserva"]->ra_habitacion_decorada,
                            date('Y-m-d H:i:s'),
                            $request["tipo_pago"],
                            $dataReserva["data"]["reserva"]->tiempo_transcurido,
                            $dataReserva["data"]["financieros"]["total"],
                            $dataReserva["data"]["reserva"]->ra_tipo_reserva_inicio,
                            $request["cantidad_efectivo"],
                            $request["cantidad_credito"],
                            $request["cantidad_transferencia"]
                         ),array(""));
                    }else{
                        $insert = $this->masterModel->insert("facturas",array(
                            $numeroDefactura,
                            $dataReserva["data"]["reserva"]->id_reserva,
                            $dataReserva["data"]["reserva"]->hab_numero,
                            $dataReserva["data"]["reserva"]->id_usuario,
                            $dataReserva["data"]["reserva"]->ra_fecha_hora_ingreso,
                            $dataReserva["data"]["reserva"]->ra_inicio_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_fin_tiempo_parcial,
                            $dataReserva["data"]["reserva"]->ra_numero_personas_adicionales,
                            $dataReserva["data"]["reserva"]->ra_habitacion_decorada,
                            date('Y-m-d H:i:s'),
                            $request["tipo_pago"],
                            $dataReserva["data"]["reserva"]->tiempo_transcurido,
                            $dataReserva["data"]["financieros"]["total"],
                            $dataReserva["data"]["reserva"]->ra_tipo_reserva_inicio,
                            $request["cantidad_efectivo"],
                            $request["cantidad_credito"],
                            $request["cantidad_transferencia"]
                         ),array("promo_id"));
                    }
                    //si los productos esta en 0 entrara al if
                    $insertProducts = true;
                    if($insert){
                        //agregar productos
                        foreach($dataReserva["data"]["productos"] as $product){
                            $insertProducts = $this->masterModel->insert("detalle_factura",array(
                                $numeroDefactura,
                                $product->re_det_id_producto,
                                $product->re_det_cantidad,
                                $product->re_precio_compra,
                                $product->re_det_valor_unidad,
                                $product->re_det_valor_total,
                                date('Y-m-d H:i:s')
                            ),array("id_detalle"));
                        }
                        if($insertProducts){
                            $deleteReserva=$this->masterModel->delete("reserva_activa",array("id_reserva",$dataReserva["data"]["reserva"]->id_reserva));
                            if($deleteReserva){
                                //cambiar habitacion a limpieza
                                $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE  hab_numero = ?",array(6,$dataReserva["data"]["reserva"]->hab_numero));
                                if($update){
                                    $status = "success";
                                    $message = "Factura creada.";
                                    $dataReserva["data"]["reserva"]->fecha= date('Y-m-d H:i:s');
                                    $dataReserva["data"]["financieros"]["tipo_pago"]= $request["tipo_pago"];
                                    $dataReserva["data"]["financieros"]["valor_pago_efectivo"]= $request["cantidad_efectivo"];
                                    $dataReserva["data"]["financieros"]["valor_pago_credito"]= $request["cantidad_credito"];
                                    $dataReserva["data"]["financieros"]["valor_pago_transferencia"]= $request["cantidad_transferencia"];
                                    $dataReserva["data"]["configuracion_factura"]= $this->masterModel->selectAll("villa_conf_facturas")[0];
                                    $dataReserva["data"]["financieros"]["iva"]=  ($dataReserva["data"]["financieros"]["total"]*intval($valorIva))/100;
                                    $dataReserva["data"]["financieros"]["baseIva"]=  number_format($dataReserva["data"]["financieros"]["total"]/119,2);
                                    $dataReserva["data"]["financieros"]["subtotal"]=  $dataReserva["data"]["financieros"]["total"]-$dataReserva["data"]["financieros"]["iva"];
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "Error al momento de cambiar el estado de la habitación.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Error al momento de guardar los productos de la factura.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Error al momento de guardar los productos de la factura.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Error al momento de guardar la factura.";
                    }
                }
                $result = array("status"=>$status,"message"=>$message,"factura"=>$numeroDefactura,"data"=>$dataReserva["data"]);
                echo json_encode($result);
            }else{
                echo json_encode($dataReserva);
            }
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function crearCortesia($dataReserva,$request){
        //obtener el numero de la cortesia
        $numeroDeCortesia = $this->masterModel->sqlSelect("SELECT MAX(cor_consecutivo) as ultimaCortesia FROM cortesia",array(""))[0]->ultimaCortesia+1;
        //guardar cortesia
        $insert = $this->masterModel->insert("cortesia",array(
            $numeroDeCortesia,
            $dataReserva["data"]["reserva"]->hab_numero,
            $dataReserva["data"]["reserva"]->id_usuario,
            $dataReserva["data"]["reserva"]->ra_fecha_hora_ingreso,
            $dataReserva["data"]["reserva"]->ra_inicio_tiempo_parcial,
            $dataReserva["data"]["reserva"]->ra_fin_tiempo_parcial,
            $dataReserva["data"]["reserva"]->ra_numero_personas_adicionales,
            $dataReserva["data"]["reserva"]->ra_habitacion_decorada,
            date('Y-m-d H:i:s'),
            $request["tipo_pago"],
            $dataReserva["data"]["reserva"]->tiempo_transcurido,
            $dataReserva["data"]["reserva"]->ra_tipo_cortesia,
            $request["cantidad_efectivo"],
            $request["cantidad_credito"],
            $request["cantidad_transferencia"]
        ));
        if($insert){
            //agregar productos
            foreach($dataReserva["data"]["productos"] as $product){
                $insertProducts = $this->masterModel->insert("detalle_cortesia",array(
                    $numeroDeCortesia,
                    $product->re_det_id_producto,
                    $product->re_det_cantidad,
                    $product->re_precio_compra,
                    $product->re_det_valor_unidad,
                    $product->re_det_valor_total,
                    date('Y-m-d H:i:s')
                ),array("id_detalle"));
            }
            if($insertProducts){
                $delete = $this->masterModel->delete("reserva_activa",array("hab_numero",$dataReserva["data"]["reserva"]->hab_numero));
                if($delete){
                    //cambiar habitacion a limpieza
                    $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE  hab_numero = ?",array(6,$dataReserva["data"]["reserva"]->hab_numero));
                    if($update){
                        $numeroDeCortesia = $numeroDeCortesia;
                        $status ="success";
                        $message="cortesia faturada";
                    }else{
                        header('Internal server error', true, 500);
                        $numeroDeCortesia = null;
                        $status = "error";
                        $message = "Error al momento de cambiar el estado de la reserva.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $numeroDeCortesia = null;
                    $status = "error";
                    $message = "Error al momento de eliminar la reserva.";
                }
            }else{
                header('Internal server error', true, 500);
                $numeroDeCortesia = null;
                $status = "error";
                $message = "Error al momento de guardar los productos.";
            }
        }else{
            header('Internal server error', true, 500);
            $numeroDeCortesia = null;
            $status = "error";
            $message = "Error al momento de guardar la cortesia.";
        }
        $result =array("numeroCortesia"=>$numeroDeCortesia,"status"=>$status,"message"=> $message,"reserva"=>$dataReserva["data"]["reserva"]);
        echo json_encode($result);
        return ;
    }

    function readByInvoice(){
        header('Content-Type:application/json');
        $request = $_POST;
        if(isset($request["fechaInicial"]) && isset($request["fechaFinal"])){
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM facturas WHERE fac_hora_salida BETWEEN ? AND ? ",array($request["fechaInicial"],$request["fechaFinal"]));
        }else if(isset($request["fac_consecutivo"])){
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM facturas WHERE fac_consecutivo = ? ",array($request["fac_consecutivo"]));
        }else if(isset($request["id_reserva"])){
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM facturas WHERE id_reserva = ? ",array($request["id_reserva"]));
        }else{
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM facturas ORDER BY fac_hora_salida DESC   LIMIT 300",array(""));
        }
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
    
    function obtenerDetallesFactura(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM facturas WHERE  fac_consecutivo =  ?",array($request["consecutivo"]));
            if(!empty($dataType)){
                $valorIva = $this->masterModel->sqlSelect("SELECT  conf_iva FROM villa_config",array(""))[0]->conf_iva;
                $dataType[0]->productos = $this->masterModel->sqlSelect("SELECT df.*,p.pro_nombre FROM detalle_factura df INNER JOIN  producto p ON p.id_producto = df.det_id_producto WHERE  fac_consecutivo =  ?",array($request["consecutivo"]));
                $dataType[0]->caja = $this->masterModel->sqlSelect("SELECT usu_nombres FROM usuario  WHERE  usu_id =  ?",array($dataType[0]->id_usuario));
                $dataType[0]->configuracionFatura = $this->masterModel->sqlSelect("SELECT * FROM villa_conf_facturas ",array(""))[0];
                $dataType[0]->iva=  (intval($dataType[0]->valor_factura)*intval($valorIva))/100;
                $dataType[0]->baseIva=  number_format(intval($dataType[0]->valor_factura)/119,2);
                $dataType[0]->subtotal=  intval($dataType[0]->valor_factura)-$dataType[0]->iva;

                $totalProdutos = 0;
                foreach($dataType[0]->productos as $producto){
                    $totalProdutos += intval($producto->det_valor_total);
                }
                $dataType[0]->totalSoloTiempo = intval($dataType[0]->valor_factura)- $totalProdutos ;
                $dataType[0]->totalSoloProductos =$totalProdutos;
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