<?php 
Class CategoriasController{
    private  $masterModel;
    private $doizer;
    function CategoriasController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function createCategory(){
        header('Content-Type:application/json');
        if(!empty($_POST)){
            $request = $_POST;
            //validar  si la categoris  existe
            $request["fecha_creacion"] = date("Y-m-d");

            if($request["nombre"]!= ""){
                $categoria = $this->masterModel->sqlSelect("SELECT id_categoria FROM categorias WHERE cat_nombre = ? ",array($request["nombre"]));
                if(empty($categoria)){
                    $insert = $this->masterModel->insert("categorias",array($request["nombre"],$request["descripcion"],$request["fecha_creacion"]),array("id_categoria"));
                    if($insert){
                        $status = "success";
                        $message = "Categoria registrado exitosamente.";
                        }else{
                            header('Internal server error', true, 500);
                            $status = "error";
                            $message = "error guardando en base de datos.";
                        }
                    }else{
                        header('Internal server error', true, 500);
                        $status = "error";
                        $message = "Esta categoria ya se encuentra registrado en el sistema.";
                    }
            }else{
                header('Internal server error', true, 500);
                $status = "error";
                $message = "Por favor ingresa el nombre de  la categoria.";
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
                    $message = "Debido a que esta categoria tiene productos ralacionados no se puede eliminar.";
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