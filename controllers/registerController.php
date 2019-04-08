<?php 

class registerController extends Controller {

	public function index()
	{

		$data['title'] = "Cadastra -se - ";
		$data['active'] = "register";

		$this->loadTemplate('register', $data);
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

			if($result) {
				header("Location: ".BASE_URL);
				exit;
			}
		} else {
			$data['error'] = true;
		}


	}
}