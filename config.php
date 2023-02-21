<?php

namespace WESLEIFELIX{

    use PDO;
    use PDOException;
    use stdClass;

        class Config{
            public $database;
            private $table = "users";

            public function __construct()
            {
                $this->connect();
            }

            public function connect(){
                $host = '177.72.160.174';
                $database = 'livypradocom_teste_api';
                $user = 'livypradocom_tester';
                $pass = 'bQ#U[gt83Jj%';
          
                try
                {
                    $connect = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);
                    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $this->database = $connect;
                    return $connect;
                }
                catch(PDOException $error)
                {
                    echo 'ERROR: ' . $error->getMessage();
                }
            }

            public function List(){
                
                $sql = 'SELECT * FROM '.$this->table.'';
                $data =  $this->database->query($sql);
        
                return $data;
            }
        
        
            public function Where($param){
                $data = $this->database->query('SELECT * FROM '.$this->table.' WHERE '.$param.'');
                return $data;
            }
        
            public function Insert($data){
                
                unset($data['id']);
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
                    $sql = 'INSERT INTO '.$this->table.' ('.$fiels.') VALUES ('.$values.')';
        
        
                    // Prepare statement
                    $stmt =  $this->database->prepare($sql);
        
                    // execute the query
                    $stmt->execute();
                    return true;
                   // return $this->findObjectByEmail($user->email);
                }
                catch(PDOException $e)
                {
                    return false;
                    
                }
        
            }
        
            public function Update($data, $key, $keyvalue){
        
                $fiels = "";
        
                foreach(array_keys($data) as $row){
                    $fiels .= $row.' = "'. $data[$row].'",';
                }
                $fiels = rtrim($fiels,',');
        
                try{
                    $sql = 'UPDATE '.$this->table.' SET '.$fiels.' WHERE '.$key.' = '.$keyvalue;
                    $stmt =  $this->database->prepare($sql);
                    $stmt->execute();
                    header("HTTP/1.1 204 No Content");
                    return true;
                }
                catch(PDOException $e)
                {
                    return $this->BadRequest( $e->getMessage()); 
                }
        
            }
        
            public function Delete($key,$keyvalue){
        
                try{
                    $sql = 'DELETE FROM '.$this->table.' WHERE '.$key.' = '.$keyvalue;
                    $stmt =  $this->database->prepare($sql);

                    $stmt->execute();
                    header("HTTP/1.1 200");
                    return true;
                }
                catch(PDOException $e)
                {
                    return $this->BadRequest( $e->getMessage()); 
                }
        
            }
            
            public function NoFound(){
                http_response_code(404);
               
                exit();
            }

            public function BadRequest($mesage){
                http_response_code(400);
                 echo json_encode(array("error" => $mesage));
                exit();
            }

            private function returnSerialzed(stdClass $model, $data){
                $usr = new $model();
                $models = $usr->Serializer($data);
        
                return $models;
            }
        }
}