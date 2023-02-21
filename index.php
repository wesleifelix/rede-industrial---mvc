<?php
    error_reporting(E_ALL); ini_set('display_errors', 1);
    require("controllers/controller.php");
    require("models/model.php");

    if(!isset($_COOKIE['wesleiteste'])){
      $controller = "login";
      $home = new Controller($controller);
      $home::$controller->index();
    }
    else{
   
      $controller =  (isset($_GET['controller']))?$_GET['controller']:"users";
      $action = (isset($_GET['action']))?$_GET['action']:"index";
      $id = (isset($_GET['id']))?$_GET['id']:null;

        $home = new Controller($controller);

        if($id!=null)
          $home::$controller->$action($id);

        else
          $home::$controller->$action();

    }

   
?>