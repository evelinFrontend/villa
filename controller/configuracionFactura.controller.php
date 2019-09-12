
<?php 
Class ConfiguracionFacturaController{
    private  $masterModel;
    private $doizer;
    function ConfiguracionFacturaController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function UptadeConf(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $request["id"]= 1;
            if($request["resolucion"]!= ""){
                    if($request["razon_social"]!= ""){
                        if($request["nombre_empresa"]!= ""){
                            if($request["nit"]!= ""){
                                if($request["direccion"]!= ""){
                                    if($request["ciudad"]!= ""){
                                        if($request["pie_mensaje"]!= ""){
                                            if($request["telefono"]!= ""){
                                                //validar imagen
                                                if(isset($_FILES) && !empty($_FILES)){
                                                    $img["file"]=  $_FILES["imagen"];
                                                    $resultImg =  $this->doizer->ValidateImage($img,"views/assets/img/factura/");
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
                                                // modificar normal o con imagen
                                                $logo = $this->masterModel->selectAll("villa_conf_facturas");
                                                if($img==false){
                                                    $modificar = $this->masterModel->sql("UPDATE villa_conf_facturas SET conf_resolucion = ?, conf_razon_social = ?, conf_nombre_empresa = ? , conf_nit = ?, conf_direccion = ?, conf_telefono = ?, conf_ciudad = ?, conf_fecha_inicio = ?, conf_fecha_fin = ?, conf_rango_inicio = ?, conf_rango_fin = ?,conf_mensaje = ?, id_usuario = ? WHERE conf_id_fac = ?",array($request["resolucion"],$request["razon_social"],$request["nombre_empresa"],$request["nit"],$request["direccion"],$request["telefono"],$request["ciudad"],$request["fecha_inicio"],$request["fecha_fin"],$request["rango_inicio"],$request["rango_fin"],$request["pie_mensaje"],$_SESSION["DATA_USER"]["ID"],$request["id"]));
                                                }else{
                                                    $modificar = $this->masterModel->sql("UPDATE villa_conf_facturas SET conf_resolucion = ?, conf_razon_social = ?, conf_nombre_empresa = ? , conf_nit = ?, conf_direccion = ?, conf_telefono = ?, conf_ciudad = ?, conf_fecha_inicio = ?, conf_fecha_fin = ?, conf_rango_inicio = ?, conf_rango_fin = ?,conf_mensaje = ?, conf_logo = ?, id_usuario = ? WHERE conf_id_fac = ?",array($request["resolucion"],$request["razon_social"],$request["nombre_empresa"],$request["nit"],$request["direccion"],$request["telefono"],$request["ciudad"],$request["fecha_inicio"],$request["fecha_fin"],$request["rango_inicio"],$request["rango_fin"],$request["pie_mensaje"],$img,$_SESSION["DATA_USER"]["ID"],$request["id"]));
                                                }
                                                if($modificar){
                                                    if($img!=false){
                                                        unlink("views/assets/img/factura/".$logo[0]->conf_logo);
                                                    }
                                                    $status = "success";
                                                    $message = "Configuración Modificada exitosamente.";
                                                }else{
                                                    header('Internal server error', true, 500);
                                                    $status = "error";
                                                    $message = "error guardando en base de datos.";
                                                }
                                            }else{
                                                header('Internal server error', true, 500);
                                                $status = "error";
                                                $message = "Por favor ingresa el telefono.";
                                            }
                                        }else{
                                            header('Internal server error', true, 500);
                                            $status = "error";
                                            $message = "Por favor ingresa el mensaje.";
                                        }
                                    }else{
                                        header('Internal server error', true, 500);
                                        $status = "error";
                                        $message = "Por favor ingresa la ciudad.";
                                    }
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "Por favor ingresa la dirección.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Por favor ingresa el nit.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa el nombre de la empresa.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa la razón social.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por  favor ingresa la resolución.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function readByConf(){
        header('Content-Type:application/json');
        $request = $_POST;
        $dataType = $this->masterModel->selectAll("villa_conf_facturas")[0];
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