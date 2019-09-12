<?php 
Class ProveedorController{
    private  $masterModel;
    private $doizer;
    function ProveedorController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createProvider(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si el tipo de habitacion  existe
            $request["pr_fecha_creacion"] = date("Y-m-d");
            $request["pr_ultimo_aprovisionamiento"] = date("Y-m-d");

            if($request["nit"]!= ""){
                if($request["nombre"]!= ""){
                    if($request["telefono"]!= "" || $request["correo"]!= ""){
                        $existe_proveedor = $this->masterModel->sqlSelect("SELECT id_proveedor FROM proveedores WHERE pr_nit = ? OR pr_nombre = ? or pr_email = ? ",array($request["nit"],$request["nombre"],$request["correo"]));
                        if(empty($existe_proveedor)){
                            $insert = $this->masterModel->insert("proveedores",array($request["nit"],$request["nombre"],$request["razon_social"],$request["telefono"],$request["direccion"],$request["correo"],$request["numero_cuenta"],$request["tipo_cuenta"],$request["banco"],$request["pr_ultimo_aprovisionamiento"],$request["pr_fecha_creacion"]),array("id_proveedor"));
                            if($insert){
                                $status = "success";
                                $message = "Proveedor registrado exitosamente.";
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "error guardando en base de datos.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Esta proveedor ya se encuentra registrado en el sistema.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el correo o telefono.";
                    }
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Por favor ingresa el nombre.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el NIT.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UpdateProvider(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si  el proveedor
            $existe_proveedor = $this->masterModel->sqlSelect("SELECT id_proveedor FROM proveedores WHERE id_proveedor = ?",array($request["id"]));
                if(!empty($existe_proveedor)){
                    if($request["nit"]!= ""){
                        if($request["nombre"]!= ""){
                            if($request["telefono"]!= "" || $request["correo"]!= ""){
                                $update = $this->masterModel->sql("UPDATE proveedores SET pr_nit = ?, pr_nombre = ?,pr_razon_social= ?, pr_telefono = ? ,pr_direccion =?,pr_email =  ?,pr_numero_cuenta = ?, pr_tipo_cuenta = ?, pr_banco = ? WHERE id_proveedor = ?",array($request["nit"],$request["nombre"],$request["razon_social"],$request["telefono"],$request["direccion"],$request["correo"],$request["numero_cuenta"],$request["tipo_cuenta"],$request["banco"],$request["id"]));
                                if($update){
                                    $status = "success";
                                    $message = "Proveedor Modificado exitosamente.";
                                }else{
                                    header('Internal server error', true, 500);
                                    $status = "error";
                                    $message = "error guardando en base de datos.";
                                }
                            }else{
                                header('Internal server error', true, 500);
                                $status = "error";
                                $message = "Por favor ingresa el correo o telefono.";
                            }
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "Por favor ingresa el nombre.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Por favor ingresa el NIT.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este proveedor no esta registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function deleteProvider(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar la proveedor
            $existe_proveedor = $this->masterModel->sqlSelect("SELECT id_proveedor FROM proveedores WHERE id_proveedor = ?",array($request["id"]));
            if(!empty($existe_proveedor)){
                $eliminar = $this->masterModel->delete("proveedores",array("id_proveedor",$_POST["id"]));
                if($eliminar){
                    $status = "success";
                    $message = "Proveedor eliminado.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "Debido a que este proveedor tiene productos ralacionados no se puede eliminar.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este proveerdor no esta  registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readByProvider(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataType = $this->masterModel->sqlSelect("SELECT * FROM proveedores WHERE ".$request['columnDBSearch']." = ? ",array($request["value"]));
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