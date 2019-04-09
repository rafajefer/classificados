<?php 

class registerController extends Controller {

	public function index()
	{

		$data['title'] = "Criar uma conta - ";
		$data['active'] = "register";

		$this->loadTemplate('register', $data);
		unset($_SESSION['msg']['emailExistente']);
	}

	public function verificar()
	{

		$user = new Usuarios();

		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$telefone = $_POST['tel'];

		if(!empty($nome) && !empty($email) && !empty($senha) && !empty($telefone)) {

			if($user->cadastrar($nome, $email, $senha, $telefone)) {
				header("Location: ".BASE_URL."login");
				exit;
			}
		}
		
		header("Location: ".BASE_URL."register");
		exit;
		print_r($_SESSION);

	}
}