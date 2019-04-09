<?php 
 
 class loginController extends Controller {

 	public function index()
 	{
 		$this->loadTemplate('login');
 		unset($_SESSION['alert']);
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
 			header("Location: ".BASE_URL."login");
 			exit;
 		}
 	}


 }