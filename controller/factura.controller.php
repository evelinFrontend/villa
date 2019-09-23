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
                // --------fin validaciones tipo de pago------
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
                                $dataReserva["data"]["reserva"]->tipo_pago= $request["tipo_pago"];
                                $dataReserva["data"]["reserva"]->valor_pago_efectivo= $request["cantidad_efectivo"];
                                $dataReserva["data"]["reserva"]->valor_pago_credito= $request["cantidad_credito"];
                                $dataReserva["data"]["reserva"]->valor_pago_transferencia= $request["cantidad_transferencia"];
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
                $result = array("status"=>$status,"message"=>$message,"factura"=>$numeroDefactura,"data"=>$dataReserva["data"]);
                echo json_encode($result);
            }else{
                echo json_encode($dataReserva);
            }
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UptadeCategory(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si  el proveedor
            $categoria = $this->masterModel->sqlSelect("SELECT id_categoria FROM categorias WHERE id_categoria = ? ",array($request["id"]));
                if(!empty($categoria)){
                    if($request["nombre"]!= ""){
                        $delete = $this->masterModel->sql("UPDATE categorias SET cat_nombre = ?, cat_descripcion = ? WHERE id_categoria = ?",array($request["nombre"],$request["descripcion"],$request["id"]));
                        if($delete){
                            $status = "success";
                            $message = "Categoria Modificada exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el nombre de  la categoria.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Esta Categoria no esta registrada en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function deleteCategory(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar la categoria
            $categoria = $this->masterModel->sqlSelect("SELECT id_categoria FROM categorias WHERE id_categoria = ? ",array($request["id"]));
            if(!empty($categoria)){
                $eliminar = $this->masterModel->delete("categorias",array("id_categoria",$_POST["id"]));
                if($eliminar){
                    $status = "success";
                    $message = "Categoria eliminado.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Debido a que esta categoria tiene productos relacionados no se puede eliminar.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Esta categoria no esta  registrada en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readByCategory(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM categorias WHERE ".$request['columnDBSearch']." = ? ",array($request["value"]));
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