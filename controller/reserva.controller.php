<?php 
require_once "controller/tiempo.controller.php";
Class ReservaController{
    private  $masterModel;
    private $doizer;
    private $tiempoController;
    function ReservaController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
        $this->tiempoController = new TiempoController($masterModel,$doizer);
    }

    function CrearReserva(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si la habitacion tiene una reserva
            $a = $this->masterModel->delete("reserva_activa",array(1,1));
            $a = $this->masterModel->delete("reserva_activa_detalle",array(1,1));
            if($request["cortesia"]=="0" &&  $request["promocion"]!="" && $request["tipo_reserva"]!="2" || $request["cortesia"]!="0" &&  $request["promocion"]=="" && $request["tipo_reserva"]!="2" || $request["cortesia"]=="0" &&  $request["promocion"]=="" && $request["tipo_reserva"]=="2"  ){
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
                            if($request["promocion"]=="" && $request["cortesia"]=="0"){
                                $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"],$request["tipo_reserva"]),array("id_reserva","promo_id","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial","ra_tipo_cortesia"));
                            }else if($request["cortesia"]!="0"){
                                $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"],$request["tipo_reserva"],$request["cortesia"]),array("id_reserva","promo_id","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial"));
                            }else{
                                //si existe la promoción
                                $promo = $this->masterModel->selectBy("promocion",array("id_promocion",$request["promocion"]));
                                if(!empty($promo)){
                                    $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["promocion"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"],$request["tipo_reserva"]),array("id_reserva","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial","ra_tipo_cortesia"));
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "Esta promoción no se encuentra registrada.";
                                    $result = array("status"=>$status,"message"=>$message);
                                    echo json_encode($result);
                                    return;    
                                }
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
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "No puedes Usar una promoción y una cortesia al mismo tiempo, verifica el tipo de reserva.";
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

    function detallesReserva($numero_habitacion = null){
        $return = false;
        if(isset($numero_habitacion)){
            $return = true;
            $request["habitacion"] = $numero_habitacion;
        }
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT h.*,sr.*,th.*,ra.* FROM habitacion  h INNER JOIN  tipo_habitacion th ON h.id_tipo_habitacion = th.id_tipo_habitacion INNER JOIN estado_reserva sr ON sr.sr_estado_reserva = h.sr_estado_reserva INNER JOIN reserva_activa ra ON h.hab_numero = ra.hab_numero WHERE h.hab_numero = ? AND h.sr_estado_reserva != ? ",array($request["habitacion"],1))[0];
            if(!empty($dataType)){
                $status = "success";
                $message = "Consultas realizada.";
                //si tiene una reserva activa
                $datosReserva = $this->masterModel->selectBy("reserva_activa",array("hab_numero",$dataType->hab_numero));
                if( $dataType->sr_estado_reserva!=1){
                    if($datosReserva->ra_inicio_tiempo_parcial==null){
                        $dataType->tiempo_transcurido=$this->tiempoController->tiempoTranscurridoFechas($datosReserva->ra_fecha_hora_ingreso,date('Y-m-d H:i:s'));
                    }else{
                        //validar el tiempo parcial
                        if($datosReserva->ra_fin_tiempo_parcial==null){
                            $dataType->tiempo_transcurido=$this->tiempoController->tiempoTranscurridoFechas($datosReserva->ra_fecha_hora_ingreso,$datosReserva->ra_inicio_tiempo_parcial);
                        }else{
                            $tiempo_transcurido = date("Y-m-d")." ".$this->tiempoController->tiempoTranscurridoFechas($datosReserva->ra_fecha_hora_ingreso,date('Y-m-d H:i:s'));
                            $dataType->tiempo_transcurido=$this->tiempoController->restarTiempoParcial($datosReserva->ra_inicio_tiempo_parcial,$datosReserva->ra_fin_tiempo_parcial,$tiempo_transcurido);
                        }
                    }
                }
                //datos productos
                $products = $this->masterModel->selectAllBy("reserva_activa_detalle",array("id_reserva",$dataType->id_reserva));
                //datos promocion
                $promocion =null;
                if(isset($dataType->promo_id)){
                    $promocion = $this->masterModel->selectBy("promocion",array("id_promocion",$dataType->promo_id));
                }
                $toltalDineroTiempo = $this->tiempoController->timeToMoney($dataType->id_reserva,$dataType->tiempo_transcurido,$products);
                $data = array("reserva"=>$dataType,"productos"=>$products,"financieros"=>$toltalDineroTiempo,"promocion"=>$promocion);
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "no hay información asociada a esta consulta verifica si la habitación esta reservada.";
                $data = null;
            }
            $result = array("status"=>$status,"message"=>$message,"data"=>$data);
            if($return){
                return $result;
            }else{
                echo json_encode($result);
            }
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }    

    function cambiarEstadoReserva(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT ra.*,h.* FROM  reserva_activa ra INNER JOIN habitacion h ON h.hab_numero = ra.hab_numero WHERE ra.hab_numero = ?",array($request["habitacion"]))[0];
            if(!empty($dataType)){
                $dataTipoReserva = $this->masterModel->sqlSelect("SELECT er.* FROM  estado_reserva er  WHERE er.sr_estado_reserva = ?",array($request["estado_reserva"]))[0];
                if(!empty($dataTipoReserva)){
                    if($request["estado_reserva"]==1){
                        $result = $this->cambiarEstadoDisponible($dataType->id_reserva,$request["estado_reserva"],$dataType->sr_estado_reserva,$request["habitacion"]);
                    }else if($request["estado_reserva"]==3){
                        $result = $this->cambiarEstadTiempoParcial($dataType->id_reserva,$request["estado_reserva"],$dataType->sr_estado_reserva,$request["habitacion"],$dataType->ra_inicio_tiempo_parcial,$dataType->ra_fin_tiempo_parcial,$dataType->ra_tipo_reserva_inicio);
                    }else{
                        $result["status"] = "error";
                        $result["message"] = "Estado no disponible para cambiar.";
                        $result["error"] = true;
                    }
                    $status = $result["status"];
                    $message = $result["message"];
                    if($result["error"]){
                        header('Internal server error', true, 500);
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Este estado de reserva no existe en nuestro sistema.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "no hay información asociada a esta consulta verifica si la habitación esta reservada.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function cambiarEstadoDisponible($id_reserva,$nuevo_estado,$estadoActualReserva,$numeroHabitacion){
        //si esta en limpieza y va a pasar a disponible
        if($estadoActualReserva==6 && $nuevo_estado==1){
            $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE hab_numero = ?",array(1,$numeroHabitacion));
            if($update){
                $status = "success";
                $message = "estado Cambiado";
                $error = false;
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Error al momento de modificar.";
                $error = true;
            }
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "No puedes cambiar de tu estado Actual a disponible,intenta facturando o cuando este en limpieza.";
            $error = true;
        }
        $result = array("status"=>$status,"message"=>$message,"error"=>$error);
        return $result;
    }
    function cambiarEstadTiempoParcial($id_reserva,$nuevo_estado,$estadoActualReserva,$numeroHabitacion,$inicioTiempo,$finTiempo,$tipoReserva){
        //si esta en reserva o promocion  y va a pasar a timpo parcial
        if(($estadoActualReserva==2 || $estadoActualReserva==5 || $nuevo_estado==3) && $nuevo_estado==3){
            //cambiar el estado de la habitacion
            $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE hab_numero = ?",array(3,$numeroHabitacion));
            if($update){
                //validar si es abrir o cerrar el tiempo parcial
                if($inicioTiempo==null && $finTiempo == null ){
                    //Inicializar el inicio del tiempo parcial
                    $iniciarTiempoParcial =  $this->masterModel->sql("UPDATE reserva_activa SET ra_inicio_tiempo_parcial = ? WHERE id_reserva = ?",array(date('Y-m-d H:i:s'),$id_reserva));
                    if($iniciarTiempoParcial){
                        $status = "success";
                        $message = "Tiempo parcial Iniciado";
                        $error = false;
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Error al momento de modificar.";
                        $error = true;
                    }
                }else if(!$inicioTiempo==null && $finTiempo == null){
                    //reestablecer tipo de reserva a el valor original
                    $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE hab_numero = ?",array($tipoReserva,$numeroHabitacion));
                    //finaliar tiempo parcial
                    $finalizarTiempoParcial =  $this->masterModel->sql("UPDATE reserva_activa SET ra_fin_tiempo_parcial = ? WHERE id_reserva = ?",array(date('Y-m-d H:i:s'),$id_reserva));
                    if($finalizarTiempoParcial && $update){
                        $status = "success";
                        $message = "Tiempo parcial Finalizado";
                        $error = false;
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Error al momento de modificar.";
                        $error = true;
                    }
                }else{
                    //reiniciar el ciclo
                    $reiniciarTiempoParcial =  $this->masterModel->sql("UPDATE reserva_activa SET ra_inicio_tiempo_parcial = ? , ra_fin_tiempo_parcial = ? WHERE id_reserva = ?",array(date('Y-m-d H:i:s'),null,$id_reserva));
                    if($reiniciarTiempoParcial){
                        $status = "success";
                        $message = "Tiempo parcial Iniciado";
                        $error = false;
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Error al momento de modificar.";
                        $error = true;
                    }
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Error al momento de modificar.";
                $error = true;
            }
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "No puedes cambiar de tu estado a tiempo parcial,intenta en una habitación reservada.";
            $error = true;
        }
        $result = array("status"=>$status,"message"=>$message,"error"=>$error);
        return $result;
    }

    function cancelarReserva(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            if($request["id_reserva"]!=""){
                if($request["motivo"]!=""){
                    //validar si exite la reserva
                    $existeReserva = $this->masterModel->sqlSelect("SELECT * FROM reserva_activa WHERE id_reserva = ? ",array($request["id_reserva"]))[0];
                    if(!empty($existeReserva)){
                        //validar si la reserva tiene productos
                        $existenProductos = $this->masterModel->sqlSelect("SELECT id_reserva FROM reserva_activa_detalle WHERE id_reserva = ? ",array($request["id_reserva"]));
                        if(empty($existenProductos)){
                            //validar promocion
                            if(isset($existeReserva->promo_id)){
                                $insert = $this->masterModel->insert("reservas_anuladas",array($existeReserva->hab_numero,$existeReserva->id_usuario,$existeReserva->promo_id,$existeReserva->ra_fecha_hora_ingreso,$existeReserva->ra_habitacion_decorada,$request["motivo"]),array("id_anulacion"));
                            }else{
                                $insert = $this->masterModel->insert("reservas_anuladas",array($existeReserva->hab_numero,$existeReserva->id_usuario,$existeReserva->ra_fecha_hora_ingreso,$existeReserva->ra_habitacion_decorada,$request["motivo"]),array("id_anulacion","promo_id"));
                            }
                            if($insert){
                                $delete = $this->masterModel->delete("reserva_activa",array("id_reserva",$request["id_reserva"]));
                                if($delete){
                                    $status = "success";
                                    $message = "Reserva cancelada";
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "error al eliminar reserva.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "error en base de datos.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Esta reserva no se puede cancelar debido a que tiene productos Registrados.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Este id de reserva no esta registrado.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Ingresa el motivo de la cancelación.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "ingresa el numero de la reserva.";
            }
        }else{
            header('Internal server error', true, 500);
            $status = "error";
            $message = "no hay información asociada a esta consulta verifica si la habitación esta reservada.";
        }
        $result = array("status"=>$status,"message"=>$message);
        echo  json_encode($result);
    }
}
?>