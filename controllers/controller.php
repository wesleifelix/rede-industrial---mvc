<?php
//require_once("models/model.php");
class Controller
{
    public static $controller;

    public function redirect($url)
    {
        header('Location: ' . $url);
    }

    function __construct($_controller){
        require_once $_controller."Controller.php";
        eval('Controller::$controller = new ' . $_controller . 'Controller();');
        return Controller::$controller;
                
    }


}
?>