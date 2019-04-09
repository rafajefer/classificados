<?php 
 
 class loginController extends Controller {

 	public function index()
 	{
 		$this->loadTemplate('login');
 		unset($_SESSION['msg']);
 	}

 	public function verificar()
 	{
 		$email = $_POST['email'];
 		$senha = $_POST['senha'];

 		$user = new Usuarios();
 		if($user->login($email, $senha)) {
 			header("Location: ".BASE_URL);
 			exit;
 		} else {
 			$_SESSION['msg'] = array('login');
 			header("Location: ".BASE_URL."login");
 			exit;
 		}
 	}

 }