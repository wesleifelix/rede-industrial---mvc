<?php

class usersController
{

    public $view;
    public $title;
    public $controller;	
    public $model;
    public $_context; 
	
    public function __construct()
    {
        $this->_context = new Model();
    	$this->controller = "users";
        $this->title = "Lista";
        $this->view = $this->SetView();
        $this->model = $this->_context::DbSet("users");
    }

    public function Index(){
    	
        $retorno = Model::List($this->model);
		$this->view->print(__FUNCTION__,$retorno);

    }
    
   
    
    public function details(){

        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':
               
                $params = "id = ".$_GET['id'];
                $retorno = Model::Where($params,$this->model);
                $this->view->print("details",$retorno[0], false);
                break;
            case 'POST':
                header('Access-Control-Allow-Origin: *');
                header("Content-type: application/json; charset=utf-8");

                $formulario = $_POST;
 
                $response = $this->_context::Update($this->model,"id",$_GET['id'],$formulario);
                if($response){
                    http_response_code(204);
                    echo json_encode(array("success" => true));
                    exit;
                    break;
                }
                else{
                    http_response_code(400);
                    echo json_encode(array( "error" => true, "message" => "Não foi possivel editar"));

                    exit;
                }
                header("location:index.php?controller=users");
                break;
        }
        

    }

    public function create(){

        

        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':
                $this->view->print(__FUNCTION__,$this->model, false);
                break;
            case 'POST':
                $formulario = $_POST;
                header('Access-Control-Allow-Origin: *');
                header("Content-type: application/json; charset=utf-8");
                
                try{

                    $params = "email = '". $formulario['email']. "'";
                    $user = $this->_context::Where($params, $this->model);
                    if(count($user) > 0){
                        http_response_code(400);
                        echo json_encode(array( "error" => true, "message" => "E-mail já cadastrado"));

                        exit;
                    }
                    if(Model::Insert($this->model,$formulario)){
                        $params = "email = '". $formulario['email']. "'";
                        $user = $this->_context::Where($params, $this->model);
               
                        if(count($user) > 0){

                            if($user[0]->email == $_POST['email'] ){
                                unset($user[0]->table);
                                
                                http_response_code(201);
                                
                                echo json_encode($user[0]);

                                exit;
                            }
                        }
                    } 
                }
                catch(Exception $e){
                    //print_r($e);
                }
                $this->view->print(__FUNCTION__,$this->model);
                
                break;
        }

    }


    public function delete(){

        //$faqs = $this->_context::DbSet("hook");

        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':

                $params = "id = ".$_GET['id'];
                $retorno = Model::Where($params,$this->model);

                $this->view->print(__FUNCTION__,$retorno[0], false);
                break;
            case 'POST':
                header('Access-Control-Allow-Origin: *');
                header("Content-type: application/json; charset=utf-8");

                $response = Model::Delete($this->model,"id" ,$_GET['id']);

                http_response_code(200);
                echo json_encode(array("success" => true));
                exit;
                break;
        }
        //$this->view->print(__FUNCTION__,null);
    }
    

		public function SetView(){

			require ("Views/View.php");
	
			$view = new View($this->controller);
	
			return $view;
		}
	
}
?>