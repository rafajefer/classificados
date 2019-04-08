<?php 

class Usuarios extends Model {

	private $table = 'usuarios';

	public function cadastrar($nome, $email, $senha, $tel) {
		
		$sql = "SELECT id FROM $this->table WHERE email = : email";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();

		if($stmt->rowCount() == 0) {
			$this->insert($nome, $email, $senha, $tel);
		} else {
			// E-mail existente
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
			return true;
		} else {
			return false;
		}
	}
}