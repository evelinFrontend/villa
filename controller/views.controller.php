<?php 

class ViewsController{
    private $masterModel;
  
    function main(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/modules/login.php";
        require_once "views/include/admin/scoope.footer.php";

    }
    
}

?>