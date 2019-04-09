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

			$result = $user->cadastrar($nome, $email, $senha, $telefone);
			//print_r($result);
			if($result) {
				header("Location: ".BASE_URL."register");
				exit;
			}
		} else {
			header("Location: ".BASE_URL."register");
			exit;
		}

	}
}