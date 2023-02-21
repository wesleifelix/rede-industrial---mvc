<?php


    class User{
        public $id;
        public $nome;
        public $email;
        public $senha;

        public  $table = "users";

        private $database;

        public function __construct($database = null)
        {
            $this->database = $database;
        }

        public function Serializer($data){
            $models = new ArrayObject();
            if($data == null){
                return $models;
            }
            
            foreach($data as $row) {
    
                $cs = new User();
    
                $cs->id = $row['id'];
                $cs->nome = $row['nome'];
                $cs->email = $row['email'];
                $cs->senha = $row['senha'];
                unset($row['table']);
                $models->append($cs);
    
            }
            return (array)$models;
        }

        function findObjectByEmail($email){
                
            $param = "email = '".$email."'";
            $data = $this->database::Where($param);
           
            if(count($data) > 0)
                return true;
        }

        function findObjectByID($id){
            
            $param = "id = '".$id."'";
            $data = $this->database::Where($param);
           
            return ( (array)$data);
        }

        

    }

