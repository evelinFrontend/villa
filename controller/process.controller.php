<?php 
Class ProcessController{
    private  $masterModel;
    private $doizer;
    function ProcessController($masterModel,$doizer){
        $this->masterModel = $masterModel;
        $this->doizer = $doizer;
    }

    function iniciarProceso(){
        header('Content-Type:application/json');
        // if(!empty($_POST)){
            $request = $_POST;
            $this->realizarBackup();
            $status = "success";
            $message = "Categoria registrado exitosamente.";
            $result = array("status"=>$status,"message"=>$message);
            echo json_encode($result);
        // }else{
        //     header('405 Method Not Allowede', true, 405);
        // }
    }

    function realizarBackup(){
        $this->doizer->exportarTablas("localhost", "root", "", "villa_campestre");
    }
}
?>