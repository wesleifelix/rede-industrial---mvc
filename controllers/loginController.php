<?php

class loginController
{

    public $view;
    public $title;
    public $controller;	
    public $_model;
    public $_context; 
    private $error;
	
    public function __construct()
    {
        $this->_context = new Model();
    	$this->controller = "login";
        $this->view = $this->SetView();
        $this->_model = $this->_context::DbSet("users");
    }

    public function Index(){
    	
			switch($_SERVER['REQUEST_METHOD']){
				case 'GET':
					if(isset($_COOKIE['testeweslei'])){
                        header ("location: /user");
						return;
					}else{
						return $this->view->print(__FUNCTION__,null,false);
					}
					break;
				case 'POST':
                    header('Access-Control-Allow-Origin: *');
                    header("Content-type: application/json; charset=utf-8");
    
                    $return = $this->login();
					return $this->view->print(__FUNCTION__,$return,false);

			}

	}

    
	private function inicia_sessao($user,$id){
			//session_start();
			ob_clean();
			ob_start();
			
			 setcookie('testewesleiname', $user, (time() + (3 * 3600)));
			 setcookie('testeweslei', $id, (time() + (3 * 3600)));
			 ob_flush();
			 header("location:index.php?controller=user");
	  }

		public function SetView(){

			require ("Views/View.php");
	
			$view = new View($this->controller);
	
			return $view;
		}
	


	public function login(){
		$this->error = "Usuário ou senha incorreto";

		switch($_SERVER['REQUEST_METHOD']){
			case 'POST':
				
				$params = "email = '".$_POST['email']."' AND  senha = '".$_POST["senha"]. "'";
				
				$user = $this->_context::Where($params, $this->_model);
               
				if(count($user) > 0){

					if($user[0]->email == $_POST['email'] ){
                        unset($user[0]->table);
						setcookie("wesleiteste", $user[0]->id, time()+3600, "/");
						setcookie("wesleitestename", $user[0]->nome , time()+3600, "/");
						http_response_code(200);
                        
                        echo json_encode($user[0]);

                        exit;
					}
					
                    http_response_code(400);
                    echo json_encode(array( "error" => true, "message" => "Usuário ou senha incorreto"));
					exit;

					break;
				}

                http_response_code(400);
                echo json_encode(array( "error" => true, "message" => "Usuário ou senha incorreto"));
                exit;

                break;

		}
	}
}
?>