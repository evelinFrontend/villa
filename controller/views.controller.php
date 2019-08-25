<?php 

class ViewsController{
    private $masterModel;
  
    function main(){
        require_once "views/modules/login.php";
    }
    function home(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/home.php";
        require_once "views/include/admin/scoope.footer.php";

    }
    
}

?>