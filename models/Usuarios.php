<?php 

class Usuarios extends Model {

	private $table = 'usuarios';

	public function cadastrar($nome, $email, $senha, $tel) {
		
		// Verifica se usuário existe
		$sql = "SELECT id FROM $this->table WHERE email = :email";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();

		if($stmt->rowCount() == 0) {
			$this->insert($nome, $email, $senha, $tel);
		} else {
			// E-mail existente
			$_SESSION['msg']['emailExistente'] = "Este  usuário já existe! <a href='".BASE_URL."login' class='alert-link'>Faça login agora</a>";
				header("Location: ".BASE_URL."register");
				exit;
		}

	}

	public function login($email, $senha)
	{
		$sql = "SELECT id FROM $this->table WHERE email = :email AND senha = :senha";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->bindValue(":senha", md5($senha), PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			$data = $stmt->fetch();
			$_SESSION['cLogin'] = $data['id'];
			return true;
		} else {
			return false;
		}
	}

	private function insert($nome, $email, $senha, $tel)
	{
		$sql = "INSERT INTO $this->table (nome, email, senha, telefone) VALUES(?,?,?,?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(1, $nome, PDO::PARAM_STR);
		$stmt->bindValue(2, $email, PDO::PARAM_STR);
		$stmt->bindValue(3, md5($senha), PDO::PARAM_STR);
		$stmt->bindValue(4, $tel, PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			$_SESSION['msg']['sucesso']['usuarioCadastro'] = "Cadastro confirmado com sucesso, $nome! Agora você já pode acessar sua conta com seu e-mail e senha.";
			return true;
		} else {
			$_SESSION['msg']['erro']['usuarioNoCadastrado'] = "Falha no cadastrado do novo usuário, tente novamente mais tarde, ou envie um e-mail para rafa.jefer@gmail.com";
			return false;
		}
	}

	
	public function getNome()
	{
		$sql = "SELECT nome FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $_SESSION['cLogin'], PDO::PARAM_INT);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			$data = $stmt->fetch();
			return $data['nome'];
		} else {
			return false;
		}
	}
}