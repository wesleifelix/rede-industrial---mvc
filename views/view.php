<?php
class View
{

    private static $controller = "";
    private static $view = "";
    private static $model;

    public function __construct($_controller)
    {
        View::$controller = strtolower($_controller);
    }

    public static function print($_view, $model, $_layout = true){

        View::$view = $_view;
        View::$model = $model;

        if($_layout){
            require_once("_layout.php");
        }

        require_once(View::$controller."/".strtolower(View::$view).".php");

    }

    public static function RenderBody(){
        require_once(View::$controller."/".strtolower(View::$view).".php");
    }
   

}
?>