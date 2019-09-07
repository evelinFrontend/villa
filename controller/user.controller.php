<?php 
Class UserController{
    private  $masterModel;
    function UserController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createUser(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar si el usuario existe
            $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_numero_documento = ? OR usu_correo = ? OR usu_nombre_login = ?",array($request["numero_documento"],$request["correo"],$request["nombre_login"]));
            if(empty($existeUsuario)){
                $request["usu_fecha_creacion"] = date("Y-m-d");
                $request["usu_estado"] = 1;
                if($request["contrasena"]==$request["rep_contrasena"]){
                    $request["contrasena"] = password_hash($request["contrasena"],PASSWORD_DEFAULT);
                    $insert = $this->masterModel->insert("usuario",array($request["nombres"],$request["apellidos"],$request["numero_documento"],$request["fecha_nacimiento"],$request["numero_contacto"],$request["correo"],$request["nombre_login"],$request["rol"],$request["contrasena"],$request["usu_fecha_creacion"],$request["usu_estado"]),array("usu_id"));
                    if($insert){
                        $status = "success";
                        $message = "usuario registrado.";
                    }else{
                        $status = "error";
                        $message = "error guardando en base de datos.";
                    }
                }else{
                    $status = "error";
                    $message = "Las contraseñas no coinciden.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este usuario ya esta registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    
    function UpdateUser(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            //validar si el usuario existe
            $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_id = ?",array($_POST["id"]));
            if(!empty($existeUsuario)){
                $request = $_POST;
                $modificar = $this->masterModel->sql("UPDATE usuario SET usu_nombres = ?,usu_apellidos = ?,usu_numero_documento = ?,usu_fecha_nacimiento = ? ,usu_numero_contacto = ?, usu_correo = ?, usu_nombre_login = ? ,usu_rol = ? WHERE usu_id = ?",array($request["nombres"],$request["apellidos"],$request["numero_documento"],$request["fecha_nacimiento"],$request["numero_contacto"],$request["correo"],$request["nombre_login"],$request["rol"],$request["id"]));
                if($modificar){
                    $status = "success";
                    $message = "usuario Modificado.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error en base de datos.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este usuario no esta  registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
        
    }

    function deleteUser(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            //validar si el usuario existe
            $existeUsuario = $this->masterModel->sqlSelect("SELECT usu_id FROM usuario WHERE usu_id = ? AND  usu_estado = ?",array($_POST["usu_id"],1));
            if(!empty($existeUsuario)){
                $eliminar = $this->masterModel->sql("UPDATE usuario SET usu_estado = ? WHERE usu_id = ?",array(0,$_POST["usu_id"]));
                if($eliminar){
                    $status = "success";
                    $message = "usuario eliminado.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $message = "error en base de datos.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este usuario no esta  registrado en el sistema.";
            }
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }

    function readUsuBy(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $dataUser = $this->masterModel->sqlSelect("SELECT * FROM usuario WHERE ".$request['columnDBSearch']." = ? AND usu_estado = ?",array($request["value"],1));
            if(!empty($dataUser)){
                $status = "success";
                $message = "Consultas realizada.";
                $data = $dataUser;
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