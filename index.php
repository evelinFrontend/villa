<?php
    session_start();
    require_once "model/conn.model.php";
    require_once "model/master.model.php";
    require_once "controller/doizer.controller.php";
    $masterModel = masterModel();
    $doizer = new DoizerController();
    if (isset($_REQUEST['controller'])) {
        //requerir archivo
        $controller=strtolower($_REQUEST['controller']);
        require_once "controller/$controller.controller.php";
        //requerir clase
        $controller = ucwords($controller)."Controller";
        $controller = new $controller($masterModel,$doizer);
        //preguntamos si hay accion si no hay por defecto es main
        $action = isset($_REQUEST['a']) ? $_REQUEST['a']:'main';
        call_user_func(array($controller,$action));
    }else {
        $controller = "views";
            //requerir archivo
        require_once "controller/$controller.controller.php";
            //requerir clase
        $controller = ucwords($controller)."Controller";
        $controller = new $controller;
        $controller->main();
    }
    // trigger_error("Unauthorized", E_USER_ERROR);
?>