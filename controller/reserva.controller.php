<?php 
Class ReservaController{
    private  $masterModel;
    private $doizer;
    function ReservaController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function CrearReserva(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si la habitacion tiene una reserva
            // $a = $this->masterModel->delete("reserva_activa",array(1,1));
            // $a = $this->masterModel->delete("reserva_activa_detalle",array(1,1));
            if($request["hab_numero"]!= "" && $request["tipo_reserva"]!= "" ){
                $request["fecha_ingreso"] =date('Y-m-d H:i:s');
                $existeReserva = $this->masterModel->sqlSelect("SELECT id_reserva FROM reserva_activa WHERE hab_numero = ? ",array($request["hab_numero"]));
                if(empty($existeReserva)){
                    $existeTipoReserva = $this->masterModel->sqlSelect("SELECT sr_estado_reserva FROM estado_reserva WHERE sr_estado_reserva = ? ",array($request["tipo_reserva"]));
                    if(!empty($existeTipoReserva)){
                        //comentar 
                        $products = json_decode($request["productos"],true);
                        //validar productos
                        $i = 0;
                        foreach($products as $product){
                            $existeProducto = $this->masterModel->sqlSelect("SELECT id_producto FROM producto WHERE id_producto = ? ",array($product["id"]))[0];
                            if(empty($existeProducto)){
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "El producto en la posición(".$i.") no existe.";
                                $result = array("status"=>$status,"message"=>$message);
                                echo json_encode($result);
                                return;
                            }
                            if($product["cantidad"]<1 ){
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Valor  no valido en el pruducto N(".$i.").";
                                $result = array("status"=>$status,"message"=>$message);
                                echo json_encode($result);
                                return;
                            }
                            $i++;
                        }
                        //validar si existe promocion
                        if($request["promocion"]==""){
                            $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"]),array("id_reserva","promo_id","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial"));
                        }else{
                            $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["promocion"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"]),array("id_reserva","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial"));
                        }
                        if($insert){
                            $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE hab_numero = ?",array($request["tipo_reserva"],$request["hab_numero"]));
                            if($update){
                                //obtener el numero de reserva
                                $existeReserva = $this->masterModel->sqlSelect("SELECT id_reserva FROM reserva_activa WHERE hab_numero = ? ",array($request["hab_numero"]))[0];
                                //insertar productos
                                foreach($products as $product){
                                    $dataProduct = $this->masterModel->sqlSelect("SELECT * FROM producto WHERE id_producto = ? ",array($product["id"]))[0];
                                    $totalProduct = $dataProduct->pro_precio_venta*$product["cantidad"] ;
                                    $insertProducts = $this->masterModel->insert("reserva_activa_detalle",array($existeReserva->id_reserva,$product["id"],$product["cantidad"],$dataProduct->pro_precio_compra,$dataProduct->pro_precio_venta,$totalProduct),array("id_detalle"));
                                    $nuevaCantidad = $dataProduct->pro_cantidad_disponible-$product["cantidad"];
                                    $stock = $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$product["id"]));
                                }
                                if($insertProducts && $stock){
                                    $status = "success";
                                    $message = "Reserva creada exitosamente.";
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "error guardando en base de datos al momento de registrar los productos.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "error guardando en base de datos al momento de cambiar el estado de la reserva.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos al momento de crear la reserva.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Este tipo de reserva no existe.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Esta habitación ya se encuentra reservada.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa numero de la habitación y tipo de reserva.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function ModificarReserva(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si la habitacion tiene una reserva
            if($request["id_reserva"]!= "" ){
                $existeReserva = $this->masterModel->sqlSelect("SELECT id_reserva FROM reserva_activa WHERE  id_reserva = ? ",array($request["id_reserva"]));
                if(!empty($existeReserva)){
                    //comentar 
                    $products = json_decode($request["productos"],true);
                    //validar productos
                    $i = 0;
                    foreach($products as $product){
                        $existeProducto = $this->masterModel->sqlSelect("SELECT id_producto FROM producto WHERE id_producto = ? ",array($product["id"]))[0];
                        if(empty($existeProducto)){
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "El producto en la posición(".$i.") no existe.";
                            $result = array("status"=>$status,"message"=>$message);
                            echo json_encode($result);
                            return;
                        }
                        if($product["cantidad"]<1 ){
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Valor  no valido en el pruducto N(".$i.").";
                            $result = array("status"=>$status,"message"=>$message);
                            echo json_encode($result);
                            return;
                        }
                        $i++;
                    }
                    //Modificar
                    $update = $this->masterModel->sql("UPDATE reserva_activa SET ra_numero_personas_adicionales = ?, ra_habitacion_decorada = ? WHERE id_reserva = ?",array($request["numero_personas_adicionales"],$request["habitacion_decorada"],$request["id_reserva"]));
                    if($update){  
                        //actulizar productos
                        $productosModificados = array();
                        foreach($products as $product){
                            //obtener datos del producto
                            $dataProduct = $this->masterModel->sqlSelect("SELECT * FROM producto WHERE id_producto = ? ",array($product["id"]))[0];
                            //total registrado
                            $totalProduct = $dataProduct->pro_precio_venta*$product["cantidad"] ;
                            //restablecer stock
                            //saber si hay que reestablecerlo
                            $restablecerStock = $this->masterModel->sqlSelect("SELECT re_det_cantidad FROM reserva_activa_detalle WHERE re_det_id_producto = ? AND id_reserva = ? ",array($product["id"],$request["id_reserva"]));
                            if(empty($restablecerStock)){
                                //si es un producto nuevo solo hay que descontar
                                $nuevaCantidad = $dataProduct->pro_cantidad_disponible-$product["cantidad"];
                                $stock = $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$dataProduct->id_producto)); 
                            }else{
                                //si es un prodcuto ya registrado hay que reestablecer y descontar
                                $nuevaCantidad = $dataProduct->pro_cantidad_disponible+$restablecerStock[0]->re_det_cantidad;
                                $stock = $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$dataProduct->id_producto));
                                $nuevaCantidad = $nuevaCantidad-$product["cantidad"];
                                $stock = $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$dataProduct->id_producto)); 
                            }
                            //eliminar el antiguo registro
                            $delete = $this->masterModel->sql("DELETE FROM reserva_activa_detalle WHERE re_det_id_producto = ? AND id_reserva = ? ",array($dataProduct->id_producto,$request["id_reserva"]));
                            //actualizarlo
                            $insertProducts = $this->masterModel->insert("reserva_activa_detalle",array($existeReserva[0]->id_reserva,$product["id"],$product["cantidad"],$dataProduct->pro_precio_compra,$dataProduct->pro_precio_venta,$totalProduct),array("id_detalle"));
                            $productosModificados[]=$product["id"];
                        }
                        //validar si  se elimino totalmente un producto
                        $productosEnDb = $this->masterModel->sqlSelect("SELECT re_det_id_producto FROM reserva_activa_detalle WHERE  id_reserva = ? ",array($request["id_reserva"]));
                        $productosEnDbArray= array();
                        foreach($productosEnDb as $item){
                            $productosEnDbArray[]=$item->re_det_id_producto;
                        }
                        $diff = array_diff($productosEnDbArray,$productosModificados);
                        //eliminar y reestablecer stock
                        foreach($diff as $eliminado){
                            $restablecerStock = $this->masterModel->sqlSelect("SELECT re_det_cantidad FROM reserva_activa_detalle WHERE re_det_id_producto = ? AND id_reserva = ? ",array($eliminado,$request["id_reserva"]));
                            $dataProduct = $this->masterModel->sqlSelect("SELECT * FROM producto WHERE id_producto = ? ",array($eliminado))[0];
                            $nuevaCantidad = $dataProduct->pro_cantidad_disponible+$restablecerStock[0]->re_det_cantidad;
                            $stock = $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$dataProduct->id_producto));
                            $delete = $this->masterModel->sql("DELETE FROM reserva_activa_detalle WHERE re_det_id_producto = ? AND id_reserva = ? ",array($dataProduct->id_producto,$request["id_reserva"]));
                        }
                        if($insertProducts && $stock && $delete){
                            $status = "success";
                            $message = "Reserva modificada exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos al momento de registrar los productos.";
                        }
                    }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos al momento de crear la reserva.";
                        }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Esta habitación no se encuentra reservada.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el id de la reserva.";
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