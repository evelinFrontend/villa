<?php 
Class LoginController{
    private  $masterModel;
    function LoginController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function logIn(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            $existeUsuario = $this->masterModel->sqlSelect("SELECT * FROM usuario WHERE usu_nombre_login = ?",array($request["nombre_login"]));
            if(!empty($existeUsuario)){
                if(password_verify($request["contrasena"],$existeUsuario[0]->usu_contrasena)){
                    $_SESSION["DATA_USER"]["NAME"] = $existeUsuario[0]->usu_nombres;
                    $_SESSION["DATA_USER"]["ID"] = $existeUsuario[0]->usu_id;
                    $_SESSION["DATA_USER"]["LAST_NAME"] = $existeUsuario[0]->usu_apellidos;
                    $_SESSION["DATA_USER"]["LOGIN_NAME"] = $existeUsuario[0]->usu_nombre_login;
                    $_SESSION["DATA_USER"]["ROL"] = $existeUsuario[0]->usu_rol;
                    if($existeUsuario[0]->usu_rol == 1){
                        $rolIngresado = "ADMIN"; 
                    }else if($existeUsuario[0]->usu_rol == 2){
                        $rolIngresado = "EMPLOYEE";
                    }else if($existeUsuario[0]->usu_rol == 3){
                        $rolIngresado = "SECRET";
                    }
                    $status = "success";
                    $message = "sesion iniciada.";
                }else{
                    header('Internal server error', true, 500);
                    $status = "error";
                    $rolIngresado = null;
                    $message = "Contraseña incorrecta.";
                }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Este usuario no se encuentra registrado en nuestro sistema.";
                $rolIngresado = null;
            }
            $result = array("status"=>$status,"rol"=>$rolIngresado,"message"=>$message);
            echo json_encode($result);
        }else{
            header('405 Method Not Allowede', true, 405);
        }
    }
    function logOut(){
        header('Content-Type:application/json');
        session_destroy();
        $status = "success";
        $message = "sesion finalizada.";
        $result = array("status"=>$status,"message"=>$message);
        echo json_encode($result);
    }
}
?>