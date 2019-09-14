<?php 
Class ProductoController{
    private  $masterModel;
    private $doizer;
    function ProductoController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createProduct(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar imagen
            if(isset($_FILES) && !empty($_FILES)){
                $img["file"]=  $_FILES["imagen"];
                $resultImg =  $this->doizer->ValidateImage($img,"views/assets/img/products/");
                if(is_array($resultImg)){
                    $img = $resultImg[1];
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = $resultImg;
                    $result = array("status"=>$status,"message"=>$message);
                    echo json_encode($result);
                    return ;
                }
            }else{
                $img = "img_deafult_product.jpg";
            }
            //validar  datos del producto
            $request["fecha_creacion"] = date("Y-m-d");
            if($request["codigo"]!= ""){
                if($request["nombre"]!= ""){
                    if($request["precio_venta"]>0){
                        $existeProducto = $this->masterModel->sqlSelect("SELECT id_producto FROM producto WHERE pro_codigo = ? ",array($request["codigo"]));
                        if(empty($existeProducto)){
                            //validar si existe la categoria
                            $existeCategoria = $this->masterModel->sqlSelect("SELECT id_categoria FROM categorias WHERE id_categoria = ? ",array($request["categoria"]));
                            if(!empty($existeCategoria)){
                                //validar si exite el proveedor
                                $existe_proveedor = $this->masterModel->sqlSelect("SELECT id_proveedor FROM proveedores WHERE id_proveedor = ?",array($request["proveedor"]));
                                if(!empty($existe_proveedor)){
                                    $request["pro_fecha_ultima_modificacion"]=date("Y-m-d");
                                    $request["pro_fecha_creacion"]=date("Y-m-d");
                                    $request["pro_estado"]=1;
                                    $insert = $this->masterModel->insert("producto",array($request["codigo"],$request["nombre"],$request["precio_compra"],$request["precio_venta"],$request["categoria"],$request["proveedor"],$img,$request["cantidad_disponible"],$request["pro_fecha_ultima_modificacion"],$request["pro_fecha_creacion"],$request["pro_estado"]),array("id_producto"));
                                    if($insert){
                                        $status = "success";
                                        $message = "Producto registrado exitosamente.";
                                    }else{
                                        header('Internal server error', true, 500);
                                        $status = "error";
                                        $message = "error guardando en base de datos.";
                                    }
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "El proveedor ingresado no existe en nuestro sistema.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "La categoria ingresada no existe en nuestro sistema.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Un producto con este codigo ya se encuentra registrado en el sistema.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el precio de venta del producto.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Por favor ingresa el nombre de  del producto.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el codigo del  producto.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UptadeProduct(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar imagen
            if(isset($_FILES) && !empty($_FILES)){
                $img["file"]=  $_FILES["imagen"];
                $resultImg =  $this->doizer->ValidateImage($img,"views/assets/img/products/");
                if(is_array($resultImg)){
                    $img = $resultImg[1];
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = $resultImg;
                    $result = array("status"=>$status,"message"=>$message);
                    echo json_encode($result);
                    return ;
                }
            }else{
                $img = false;
            }
            //validar  datos del producto
            if($request["codigo"]!= ""){
                if($request["nombre"]!= ""){
                    if($request["precio_venta"]>0){
                        if($request["estado"]==0 || $request["estado"]==1){
                            $existeProducto = $this->masterModel->sqlSelect("SELECT pro_imagen FROM producto WHERE id_producto = ? ",array($request["id"]));
                            if(!empty($existeProducto)){
                                //validar si existe la categoria
                                $existeCategoria = $this->masterModel->sqlSelect("SELECT id_categoria FROM categorias WHERE id_categoria = ? ",array($request["categoria"]));
                                if(!empty($existeCategoria)){
                                    //validar si exite el proveedor
                                    $existe_proveedor = $this->masterModel->sqlSelect("SELECT id_proveedor FROM proveedores WHERE id_proveedor = ?",array($request["proveedor"]));
                                    if(!empty($existe_proveedor)){
                                        $request["pro_fecha_ultima_modificacion"]=date("Y-m-d");
                                        if($img==false){
                                            $update = $this->masterModel->sql("UPDATE producto SET pro_codigo = ?,pro_nombre = ?, pro_precio_compra = ?, pro_precio_venta = ?, id_categoria = ?, id_proveedor = ?, pro_cantidad_disponible = ? ,pro_fecha_ultima_modificacion = ?,pro_estado= ? WHERE id_producto = ?",array($request["codigo"],$request["nombre"],$request["precio_compra"],$request["precio_venta"],$request["categoria"],$request["proveedor"],$request["cantidad_disponible"],$request["pro_fecha_ultima_modificacion"],$request["estado"],$request["id"]));
                                        }else{
                                            $update = $this->masterModel->sql("UPDATE producto SET pro_codigo = ?,pro_nombre = ?, pro_precio_compra = ?, pro_precio_venta = ?, id_categoria = ?, id_proveedor = ?, pro_imagen = ?, pro_cantidad_disponible = ?, pro_fecha_ultima_modificacion = ?,pro_estado= ? WHERE id_producto = ?",array($request["codigo"],$request["nombre"],$request["precio_compra"],$request["precio_venta"],$request["categoria"],$request["proveedor"],$img,$request["cantidad_disponible"],$request["pro_fecha_ultima_modificacion"],$request["estado"],$request["id"]));
                                        }
                                        if($update){
                                            if($img!=false){
                                                unlink("views/assets/img/products/".$existeProducto[0]->pro_imagen);
                                            }
                                            $status = "success";
                                            $message = "Producto modificado exitosamente.";
                                        }else{
                                            header('Internal server error', true, 500);
                                            $status = "error";
                                            $message = "error guardando en base de datos.";
                                        }
                                    }else{
                                        header('Internal server error', true, 500);
                                        $status = "error";
                                        $message = "El proveedor ingresado no existe en nuestro sistema.";
                                    }
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "La categoria ingresada no existe en nuestro sistema.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Este producto no se encuentra registrado en el sistema.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor un estado valido para el producto.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el precio de venta del producto.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Por favor ingresa el nombre de  del producto.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el codigo del  producto.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function deleteProduct(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si existe el producto
            $existeProducto = $this->masterModel->sqlSelect("SELECT pro_imagen FROM producto WHERE id_producto = ? ",array($request["id"]));
            if(!empty($existeProducto)){
                $eliminar = $this->masterModel->delete("producto",array("id_producto",$_POST["id"]));
                if($eliminar){
                    if($existeProducto[0]->pro_imagen!="img_deafult_product.jpg"){
                        unlink("views/assets/img/products/".$existeProducto[0]->pro_imagen);
                    }
                    $status = "success";
                    $message = "Producto eliminado.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Debido a que este producto tiene registros ralacionados no se puede eliminar.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este producto no esta  registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readByProduct(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT p.pro_codigo,p.pro_nombre,c.cat_nombre,pv.pr_nombre,p.id_producto,c.id_categoria,pv.id_proveedor FROM producto p INNER JOIN categorias c ON p.id_categoria = c.id_categoria INNER JOIN proveedores pv ON p.id_proveedor = pv.id_proveedor WHERE  ".$request['columnDBSearch']." = ? AND pro_estado = ?  ",array($request["value"],1));
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
    function readByCantProduct(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->sqlSelect("SELECT COUNT(*) as cantidad FROM producto p ",array(""))[0];
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
}
?>