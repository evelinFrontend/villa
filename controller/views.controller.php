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
    function setting(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/admin/scoope.menu.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/admin/setting.php";
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
    
    // employee
    
    function homeEmployee(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/employee/scoope-menu-employee.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/employee/reception.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    function invoicesEmployee(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/employee/scoope-menu-employee.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/employee/invoices.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    function closeEmployee(){
        require_once "views/include/admin/scoope.header.php";
        require_once "views/include/employee/scoope-menu-employee.php";
        require_once "views/include/admin/scoope.navbar.php";
        require_once "views/modules/employee/close.php";
        require_once "views/include/admin/scoope.footer.php";
    }
    
}

?>