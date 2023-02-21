<?php

require_once "config.php";
use \WESLEIFELIX\Config;

class Model
{

    public $erro;
    public $controller;
    public static $table;
    public static $db;
    public static $Entry;
    private static $hasKey = "fe8f38bd4910eab1058058a1654e792b";

    public function __construct()
    {
        
         Model::$db = new Config();
    }

    public static function DbSet($class){

        switch ($class) {
             
            case 'users':
                require_once "user.php";
                Model::$Entry = new User();
                return Model::$Entry;
                break;

            default:
                # code...
                break;
        }
    }

   

    public static function List($model){
        $_db = self::$db->connect();
        $data = $_db->query('SELECT * FROM '.$model->table.'');
        $sereliazed = $model->Serializer($data);
        return $sereliazed;
    }

    public static function Where($param, $model){
        $_db = self::$db->connect();
        $data = $_db->query('SELECT * FROM '.$model->table.' WHERE '.$param.'');
        $sereliazed = $model->Serializer($data);
        return $sereliazed;
    }


    public static function Insert($model,$data){

        $fiels = "";
        foreach(array_keys($data) as $row){
            $fiels .= $row.',';
        }
        $fiels = rtrim($fiels,',');

        $values = "";
        foreach(array_values($data) as $row){
            $values .= "'$row',";
        }
         $values = rtrim($values,',');

		try{
            $sql = 'INSERT INTO '.$model->table.' ('.$fiels.') VALUES ('.$values.')';
			return self::executeSQL($sql);
		}
		catch(PDOException $e)
		{
			return false;
		}

	}

    public static function Update($model,$key,$keyvalue,$data){

        $fiels = "";

        foreach(array_keys($data) as $row){
            $fiels .= $row.' = "'. $data[$row].'",';
        }
        $fiels = rtrim($fiels,',');

        try{
            $sql = 'UPDATE '.$model->table.' SET '.$fiels.' WHERE '.$key.' = '.$keyvalue;
            return self::executeSQL($sql);
        }
        catch(PDOException $e)
        {
            return false;
        }

    }

    public static function Delete($model,$key,$keyvalue){

        try{
            $sql = 'DELETE FROM '.$model->table.' WHERE '.$key.' = '.$keyvalue;
           
            return self::executeSQL($sql);
        }
        catch(PDOException $e)
        {
            echo "Erro";
            echo $e->getMessage();
            return $e->getMessage();
        }

    }

    static private function executeSQL($sql){
        try{
            $_db = self::$db->connect();
            $stmt =  $_db->prepare($sql);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e){
            return false;
        }
    }

    

}
?>