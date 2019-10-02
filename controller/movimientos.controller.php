<?php 
Class MovimientosController{
    private  $masterModel;
    private $doizer;
    function MovimientosController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createMove(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            if($request["fecha"]!= "" && $request["typeMove"]!= ""  && $request["descripcion"]!= "" && isset($request["productos"])>0){
                
                switch($request["typeMove"]){
                    case 'descontar':
                        $result = $this->masterModel->insert("movimientos",array($_SESSION["DATA_USER"]["ID"],$request["fecha"],$request["typeMove"],$request["descripcion"],date("Y-m-d")),array("id_movimiento","total"));
                        $total = 0;
                        foreach($request["productos"]  as $product){
                            $dataProduct =  $this->masterModel->sqlSelect("SELECT pro_cantidad_disponible,pro_precio_venta FROM producto  WHERE id_producto = ?",array($product["id"]))[0];
                            $precio =  $dataProduct->pro_precio_venta;
                            $total += $dataProduct->pro_precio_venta*$product["cantidad"];
                            $cantidadActual = $dataProduct->pro_cantidad_disponible;
                            $nuevaCantidad = $cantidadActual-$product["cantidad"];
                            $updateProducts =  $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$product["id"]));
                        }
                        break;
                    case 'sumar':
                        $total = 0;
                        $result = $this->masterModel->insert("movimientos",array($_SESSION["DATA_USER"]["ID"],$request["fecha"],$request["typeMove"],$request["descripcion"],date("Y-m-d")),array("id_movimiento","total"));
                        foreach($request["productos"]  as $product){
                            $dataProduct =  $this->masterModel->sqlSelect("SELECT pro_cantidad_disponible,pro_precio_venta FROM producto  WHERE id_producto = ?",array($product["id"]))[0];
                            $precio =  $dataProduct->pro_precio_venta;
                            $total += $dataProduct->pro_precio_venta*$product["cantidad"];
                            $cantidadActual = $dataProduct->pro_cantidad_disponible;
                            $nuevaCantidad = $cantidadActual+$product["cantidad"];
                            $updateProducts =  $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$product["id"]));
                        }
                        break;
                    case 'cortesia':
                        $total = 0;
                        $result = $this->masterModel->insert("movimientos",array($_SESSION["DATA_USER"]["ID"],$request["fecha"],$request["typeMove"],$request["descripcion"],date("Y-m-d")),array("id_movimiento","total"));
                        foreach($request["productos"]  as $product){
                            $dataProduct =  $this->masterModel->sqlSelect("SELECT pro_cantidad_disponible,pro_precio_venta FROM producto  WHERE id_producto = ?",array($product["id"]))[0];
                            $precio =  $dataProduct->pro_precio_venta;
                            $total += $dataProduct->pro_precio_venta*$product["cantidad"];
                            $cantidadActual = $dataProduct->pro_cantidad_disponible;
                            $nuevaCantidad = $cantidadActual-$product["cantidad"];
                            $updateProducts =  $this->masterModel->sql("UPDATE producto SET pro_cantidad_disponible = ? WHERE id_producto = ?",array($nuevaCantidad,$product["id"]));
                        }
                        break;    
                }
                if($result){
                    $ultimoMovimiento = $this->masterModel->sqlSelect("SELECT MAX(id_movimiento) as cantidad FROM movimientos",array(""))[0]->cantidad;
                    $updateMove = $this->masterModel->sql("UPDATE movimientos SET total = ? WHERE id_movimiento = ? ",array($total,$ultimoMovimiento));
                    // $products = json_decode($request["productos"],true);
                    foreach($request["productos"]  as $product){
                        $insertProducts =  $this->masterModel->insert("detalle_movimiento",array($ultimoMovimiento,$product["id"],$product["cantidad"],date("Y-m-d")),array("id_det_mov"));
                    }
                    if($insertProducts && $updateProducts && $updateMove){
                        $status = "success";
                        $message = "Movimiento registrado.";
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "error al registrar lo productos.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error al momento de crear el movimiento.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa los datos Necesarios.";
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

    function readByMoves(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->sqlSelect("SELECT m.*,u.usu_nombres FROM movimientos m INNER JOIN usuario u ON u.usu_id = m.id_usuario ",array(""));
        // $dataType = $this->masterModel->sqlSelect("SELECT * FROM movimientos m INNER JOIN detalle_movimiento dm ON dm.id_movimiento = m.id_movimiento WHERE m.id_movimiento = ?",array($request[""]));
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
    function obtenerDetalleMovimientos(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT m.*,u.usu_nombres FROM movimientos m INNER JOIN usuario u ON u.usu_id = m.id_usuario WHERE  m.id_movimiento = ? ",array($request["id_movimiento"]));
            // $dataType = $this->masterModel->sqlSelect("SELECT * FROM movimientos m INNER JOIN detalle_movimiento dm ON dm.id_movimiento = m.id_movimiento WHERE m.id_movimiento = ?",array($request[""]));
            if(!empty($dataType)){
                $dataType[0]->productos = $this->masterModel->sqlSelect("SELECT dm.*,p.pro_nombre FROM detalle_movimiento dm INNER JOIN producto p ON dm.id_producto=p.id_producto WHERE  dm.id_movimiento = ? ",array($dataType[0]->id_movimiento));
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