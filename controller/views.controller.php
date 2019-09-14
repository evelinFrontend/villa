<?php 

class ViewsController{
    private $masterModel;
  
    function main(){
        require_once "views/modules/login.php";
    }
    function home(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==1){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/admin/home.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    function invoices(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==1){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/admin/invoices.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }

    function inventory(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==1){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/admin/inventory.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    function setting(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==1){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/admin/setting.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    
    function rooms(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==1){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/admin/rooms.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    function reports(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==1){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/admin/reports.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    
    // employee
    
    function homeEmployee(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==2){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/employee/reception.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    function invoicesEmployee(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==2){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/employee/invoices.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    function closeEmployee(){
        if(isset($_SESSION["DATA_USER"]["ROL"]) && $_SESSION["DATA_USER"]["ROL"]==2){
            require_once "views/include/admin/scoope.header.php";
            require_once "views/include/admin/scoope.menu.php";
            require_once "views/include/admin/scoope.navbar.php";
            require_once "views/modules/employee/close.php";
            require_once "views/include/admin/scoope.footer.php";
        }else{
            header("Location: login");
        }
    }
    
}

?>