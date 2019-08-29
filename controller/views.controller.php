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
    function invoices(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/invoices.php";
        require_once "views/include/admin/scoope.footer.php";
    }

    function inventory(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/inventory.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    function users(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/users.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    
    function rooms(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/rooms.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    function reports(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/reports.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    
}

?>