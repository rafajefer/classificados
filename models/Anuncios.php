<?php 

class Anuncios extends AnunciosImagens {

	protected $table = 'anuncios';

	/* Busca todos os anuncios e suas imagens */
	public function getMeusAnuncios()
	{
		$sql = "SELECT *, 
		(SELECT $this->table_pai.url FROM $this->table_pai WHERE $this->table_pai.id_anuncio = anuncios.id LIMIT 1) as url 
		FROM $this->table 
		WHERE id_usuario = :id_usuario ORDER BY $this->table.titulo ASC";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id_usuario", $_SESSION['cLogin']);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Busca anuncio pelo $id*/
	public function getAnuncio($id)
	{
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id);
		$stmt->execute();

		return $stmt->fetch();
	}

	/* Adicionar um novo anuncio */
	public function addAnuncios($categoria, $titulo, $descricao, $valor, $estado, $fotos)
	{
		$sql = "INSERT INTO $this->table (id_usuario, id_categoria, titulo, descricao, valor, estado) VALUES (?,?,?,?,?,?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(1, $_SESSION['cLogin'], PDO::PARAM_INT);
		$stmt->bindValue(2, $categoria, PDO::PARAM_STR);
		$stmt->bindValue(3, $titulo);
		$stmt->bindValue(4, $descricao);
		$stmt->bindValue(5, str_replace(",",".",$valor));
		$stmt->bindValue(6, $estado);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			$lastId = $this->db->lastInsertId();
			echo $lastId."<br />";
			echo "<pre>";
			print_r($fotos);
			echo "</pre>";

			// Add imagem no diretório e no banco de dados
			if($this->AddImagens($fotos, $lastId)) {
				return true;
			}
		} 
		return false;
		
	}

	/* Editar anuncio pelo $id */
	public function editarAnuncios($id, $categoria, $titulo, $descricao, $valor, $estado, $fotos)
	{
		$sql = "UPDATE $this->table SET id_categoria = :categoria, titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado, updated_at = NOW() WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id);
		$stmt->bindValue(":categoria", $categoria);
		$stmt->bindValue(":titulo", $titulo);
		$stmt->bindValue(":descricao", $descricao);
		$stmt->bindValue(":valor", str_replace(",",".",$valor));
		$stmt->bindValue(":estado", $estado);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			// Add imagem no diretório e no banco de dados
			if($this->AddImagens($fotos, $id)) {
				return true;
			}
		}
		return false;
	}



	/* Excluir anuncio */
	public function excluirAnuncios($id)
	{

		// Verifica se foi encontrada imagens no anuncio
		if($this->getImagensAnuncio($id)){

			// Se foi encontrada imagens então exclui
			$this->excluirAnunciosImagens($id);
		}

		// Em seguida exclui o anuncio
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

		
	}

	
	


}