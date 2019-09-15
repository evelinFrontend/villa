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
            $a = $this->masterModel->delete("reserva_activa",array(1,1));
            $a = $this->masterModel->delete("reserva_activa_detalle",array(1,1));
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
                        if($request["promocion"]==""){
                            $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"]),array("id_reserva","promo_id","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial"));
                        }else{
                            $insert = $this->masterModel->insert("reserva_activa",array($request["hab_numero"],$_SESSION["DATA_USER"]["ID"],$request["promocion"],$request["fecha_ingreso"],$request["numero_personas_adicionales"],$request["habitacion_decorada"]),array("id_reserva","ra_inicio_tiempo_parcial","ra_fin_tiempo_parcial"));
                        }
                        if($insert){
                            $update = $this->masterModel->sql("UPDATE habitacion SET sr_estado_reserva = ? WHERE hab_numero = ?",array($request["tipo_reserva"],$request["hab_numero"]));
                            if($update){
                                //insertar productos
                                $existeReserva = $this->masterModel->sqlSelect("SELECT id_reserva FROM reserva_activa WHERE hab_numero = ? ",array($request["hab_numero"]))[0];
                                foreach($products as $product){
                                    $dataProduct = $this->masterModel->sqlSelect("SELECT * FROM producto WHERE id_producto = ? ",array($product["id"]))[0];
                                    $totalProduct = $dataProduct->pro_precio_venta*$product["cantidad"] ;
                                    $insertProducts = $this->masterModel->insert("reserva_activa_detalle",array($existeReserva->id_reserva,$product["id"],$product["cantidad"],$dataProduct->pro_precio_venta,$totalProduct),array("id_detalle"));
                                }
                                if($insertProducts){
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